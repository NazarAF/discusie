<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Channel;

class DiscoverController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Discover Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles view channels and join channels.
    |
    */

    /**
     * Create view channels.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = array();
        foreach (Category::get() as $category) {
            $categories["$category->category"] = [$category->id_category, collect(), 0];
        }

        foreach (Channel::with(['member' => function($query) {
            $query->where('status', '=', true);
        }])->where('permission', '=', false)->get() as $channel) {
            foreach ($categories as $key => $value) {
                if ($channel->id_category == $categories["$key"][0]) {
                    $categories["$key"][1]->push($channel);
                    $categories["$key"][2]++;
                }
            }
        }

        return view('content.discover', ['type_menu' => 'discover', 'categories' => $categories]);
    }
}
