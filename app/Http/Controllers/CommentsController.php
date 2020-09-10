<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $all_comments = Comment::orderBy('id', 'DESC')->with('post')->paginate(5);
        return view('comments.index', compact('all_comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|max:100',
            'comment' => 'required|min:3'
        ]);
        
        $new_comment = new Comment();
        $new_comment->comment = strval($request->input('comment'));
        $new_comment->name = strval($request->input('name'));
        $new_comment->email = strval($request->input('email'));
        $new_comment->post_id = intval($id);
        $new_comment->save();
        
        return redirect(url('/show/'. $id))->with('status', 'Comment added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $comment = Comment::findOrFail(intval($id));
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $comment = Comment::findOrFail(intval($id));
        return view('comments.edit', compact('comment'));
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
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|max:100',
            'comment' => 'required|min:3'
        ]);

        $comment = Comment::findOrFail(intval($id));
        $comment->name = strval($request->input('name'));
        $comment->email = strval($request->input('email'));
        $comment->comment = strval($request->input('comment'));
        $comment->save();
        
        return redirect(url('/comments'))->with('status', 'Comment updated successfully!');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $comment = Comment::findOrFail(intval($id));
        $comment->delete();
        return redirect(url('/comments'))->with('status', 'Comment deleted successfully!');          
    }
}
