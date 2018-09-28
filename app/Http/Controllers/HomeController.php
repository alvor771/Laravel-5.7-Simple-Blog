<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find($request->user()->id);
        $posts = $user->posts;
        $comments = $user->comments;

        return view('dashboard', [
            'posts' => $posts,
            'comments' => $comments
        ]);
    }
}
