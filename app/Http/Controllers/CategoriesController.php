<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $all_categories = Category::orderBy('id', 'DESC')->paginate(5);
        return view('categories.index', compact('all_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $form_array = array(
            'action' => '/categories',
            'method' => 'POST',
            'label' => 'Create'
        );
        return view('categories.create_edit', compact('form_array'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'category' => 'required|min:3|max:30'
        ]);

        $new_category = new Category();
        $new_category->category = strval($request->input('category'));
        $new_category->save();

        return redirect(url('/categories'))->with('status', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $category = Category::findOrFail($id);
        $form_array = array(
            'action' => '/categories/'. $id,
            'method' => 'PUT',
            'label' => 'Update'
        );  

        return view('categories.create_edit', compact(
            'category',
            'form_array'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'category' => 'required|min:3|max:30'
        ]);
        
        $category = Category::findOrFail(intval($id));
        $category->category = strval($request->input('category'));
        $category->save();

        return redirect(url('/categories'))->with('status', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $category_id = intval($id);
        $category = Category::findOrFail($category_id);

        $all_posts = Post::where([
            ['category_id', '=', $category_id]
        ])->get();
        foreach($all_posts as $post) {
            $post_to_delete = Post::findOrFail($post->id);
            $post_to_delete->delete();
        }
        $category->delete();

        return redirect(url('/categories'))->with('status', 'The category and all of its posts have been successfully deleted!');   
    }
}
