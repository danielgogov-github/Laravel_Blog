<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Category;
use App\Comment;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $all_posts = Post::orderBy('id', 'DESC')->with(['category', 'user'])->paginate(5);
        return view('posts.index', compact('all_posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Category::pluck('category', 'id')->all();
        $form_array = array(
            'action' => '/posts',
            'method' => 'POST',
            'label' => 'Create'
        );  
        
        return view('posts.create_edit', compact(
            'categories',
            'form_array'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'category' => 'required',
            'title' => 'required|min:3|max:50',
            'body' => 'required|min:3',
            'publish' => 'required'
        ]);
        
        $new_post = new Post();
        $new_post->title = strval($request->input('title'));
        $new_post->body = strval($request->input('body'));
        $new_post->category_id = intval($request->input('category'));
        $new_post->user_id = intval(Auth::user()->id);
        $new_post->published = intval($request->input('publish'));
        $new_post->save();   

        return redirect(url('/posts'))->with('status', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = Post::findOrFail(intval($id));
        return view('posts.show', compact('post'));         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $post = Post::findOrFail(intval($id));
        $categories = Category::pluck('category', 'id')->all();
        $form_array = array(
            'action' => '/posts/'. $id,
            'method' => 'PUT',
            'label' => 'Update'
        );
        
        return view('posts.create_edit', compact(
            'post',
            'categories',
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
            'category' => 'required',
            'title' => 'required|min:3|max:50',
            'body' => 'required|min:3',
            'publish' => 'required'
        ]);

        $post = Post::findOrFail(intval($id));
        $post->title = strval($request->input('title'));
        $post->body = strval($request->input('body'));
        $post->category_id = intval($request->input('category'));
        $post->user_id = intval(Auth::user()->id);
        $post->published = intval($request->input('publish'));
        $post->save();   

        return redirect(url('/posts'))->with('status', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $post_id = intval($id);
        $post = Post::findOrFail($post_id);

        $all_comments = Comment::where([
            ['post_id', '=', $post_id]    
        ])->get();
        foreach($all_comments as $comment) {
            $comment_to_delete = Comment::findOrFail($comment->id);
            $comment_to_delete->delete();
        }    
        $post->delete();

        return redirect(url('/posts'))->with('status', 'The post and all of its comments have been successfully deleted!');
    }

    /**
     * @param  int  $id
     * 
     */
    public function publish($id) {
        $post = Post::findOrFail(intval($id));
        if($post->published === 1) {
            $post->published = 0;
        }else {
            $post->published = 1;
        }
        $post->save();

        return redirect(url('/posts'))->with('status', 'Post published / unpublished successfully!');
    }
}
