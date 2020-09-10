<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $all_users = User::orderBy('id', 'DESC')->with('posts')->paginate(5);
        return view('users.index', compact('all_users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::findOrFail(intval($id));
        $user->delete();
        return redirect(url('/users'))->with('status', 'User deleted successfully!');          
    }
}
