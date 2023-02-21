<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoriesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Categories Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles view categories
    | store, update, and delete category.
    |
    */

    /**
     * Display category of post.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $type_menu = 'categories';
        return view('admin.categories', compact('categories', 'type_menu'));
    }

    /**
     * Store new category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'category' => 'required|max:50|unique:categories',
            'icon' => 'required|max:20|unique:categories'
        ]);

        if ($validation->fails()) {
            return back()->withErrors([
                'title' => 'Failed!',
                'message' => 'Create Category',
                'type' => 'error'
            ]);
        }

        Category::create([
            'category' => $request->category,
            'icon' => $request->icon,
        ]);

        return back()->withErrors([
            'title' => 'Success!',
            'message' => 'Create Category',
            'type' => 'success'
        ]);
    }

    /**
     * Get data category for edit.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if ($category) {
            return response()->json($category, 200);
        } else {
            return response([
                'title' => 'Gagal',
                'message' => 'Edit Category',
            ], 400);
        }
    }

    /**
     * Update category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validation = Validator::make($request->all(), [
            'category' => 'required|max:50|unique:categories',
        ]);

        if ($validation->fails()) {
            return back()->withErrors([
                'title' => 'Gagal',
                'message' => 'Update Category',
                'type' => 'error'
            ]);
        }

        $category->update([
            'category' => $request->category,
        ]);

        return back()->withErrors([
            'title' => 'Berhasil',
            'message' => 'Update User',
            'type' => 'success'
        ]);
    }

    /**
     * Remove category.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category) {
            if (Post::all()->where('category', '=', $category->category)->count() > 0) {
                return response([
                    'type' => 'error',
                    'title' => 'Gagal',
                    'message' => 'Masih Memiliki Post',
                ], 200);
            } else {
                $category->delete();
                return response([
                    'type' => 'success',
                    'title' => 'Berhasil',
                    'message' => 'Delete Category',
                ], 200);
            }
        } else {
            return response([
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Delete Category',
            ], 200);
        }
    }
}
