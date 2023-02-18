<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SettingsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Settings Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles view and settings website
    |
    */

    /**
     * Show all settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $maintenance = Maintenance::get()->first()->status;
        $type_menu = 'settings';
        return view('admin.settings', compact('maintenance', 'type_menu'));
    }

    /**
     * Optimize website.
     *
     * @return \Illuminate\Http\Response
     */
    public function optimize() {
        Artisan::call("optimize");
        return redirect(route('settings'))->withErrors([
            'title' => 'Success!',
            'message' => 'Optimize',
            'type' => 'success'
        ]);
    }

    /**
     * Clear cache.
     *
     * @return \Illuminate\Http\Response
     */
    public function cache() {
        Artisan::call("cache:clear");
        return back()->withErrors([
            'title' => 'Success!',
            'message' => "Cache Clear",
            'type' => 'success'
        ]);
    }

    /**
     * Settings routes.
     *
     * @return \Illuminate\Http\Response
     */
    public function routes($action) {
        Artisan::call("route:$action");
        $action = ucfirst($action);
        return back()->withErrors([
            'title' => 'Success!',
            'message' => "Route $action",
            'type' => 'success'
        ]);
    }

    /**
     * Settings storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function storages($action) {
        if ($action == 'delete')
            File::deleteDirectory('storage');
        else
            Artisan::call("storage:$action --force");

        $action = ucfirst($action);
        return back()->withErrors([
            'title' => 'Success!',
            'message' => "Storage $action",
            'type' => 'success'
        ]);
    }

    /**
     * Set maintenance.
     *
     * @return \Illuminate\Http\Response
     */
    public function maintenance($status) {
        $maintenance = Maintenance::get()->first();
        $maintenance->update([
            'status' => $status ? 0 : 1
        ]);

        $status = $status ? 'Stopping' : 'Running';

        return back()->withErrors([
            'title' => 'Success!',
            'message' => "$status Maintenance",
            'type' => 'success'
        ]);
    }

    /**
     * Setings sitemap.
     *
     * @return \Illuminate\Http\Response
     */
    public function sitemap($action) {
        $sitemap = Sitemap::create();

        return back()->withErrors([
            'title' => 'Success!',
            'message' => "Create Sitemap",
            'type' => 'success'
        ]);
    }
}
