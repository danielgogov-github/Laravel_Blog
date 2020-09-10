<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class FrontendController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $all_posts = Post::where([
            ['published', '=', 1]
        ])->orderBy('id', 'DESC')->with(['category', 'user', 'comments'])->paginate(7);
        $categories = $this->_prepare_categories();

        return view('frontend.index', compact(
            'all_posts',
            'categories'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */    
    public function show($id) {
        $post = Post::findOrFail(intval($id));
        $categories = $this->_prepare_categories();

        return view('frontend.show', compact(
            'post',
            'categories'
        ));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * 
     */    
    public function search(Request $request) {
        $search = strval($request->input('search'));
        $all_posts = Post::where([
            ['title', 'like', '%'. $search .'%'],
            ['published', '=', 1]
        ])->orWhere([
            ['body', 'like', '%'. $search .'%'],
            ['published', '=', 1]
        ])->paginate(7);

        return view('frontend.index', compact('all_posts'));
    }
    
    /**
     * @param  int  $id
     * 
     */
    public function show_category_posts($id) {
        $all_posts = Post::where([
            ['category_id', '=', intval($id)],
            ['published', '=', 1]
        ])->paginate(7);
        $categories = $this->_prepare_categories();

        return view('frontend.index', compact(
            'all_posts',
            'categories'
        ));
    }

    /**
     * 
     */
    private function _prepare_categories() {
        return Category::pluck('category', 'id')->all();
    }
}
