<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the blog module.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')->paginate(2);

        return view('blog.list', ['posts' => $posts]);
    }

    public function postView($id) {
        $post = \DB::table('posts')->find($id);

        if (!$post) {
            return abort(404);
        }

        return view('blog.post', ['post' => $post]);
    }
}
