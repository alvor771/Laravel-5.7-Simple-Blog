<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Post;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return view('blog.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('auth');
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('auth');

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'post_title' => 'required|max:255',
            'post_data' => 'required',
        ]);

        $imageFileName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFileName = $image->getClientOriginalName() . '_' . time() . '.' .
                $image->getClientOriginalExtension();
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('/app/public/' . $imageFileName));
        };

        $post = new Post([
            'user_id' => $request->user()->id,
            'image' => $imageFileName,
            'post_title' => $request->get('post_title'),
            'post_data' => $request->get('post_data')
        ]);
        $post->save();

        return redirect('/blog')->with('success', 'Post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return abort(404);
        }

        $post->views++;
        $post->save();

        return view('blog.post', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware('auth');

        $post = Post::find($id);

        if ($post->user_id != Auth::user()->id) {
            abort('403', 'Access Denied!');
            return redirect('/')->with('error', 'Access Denied');
        }

        return view('blog.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->middleware('auth');

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'post_title' => 'required|max:255',
            'post_data' => 'required',
        ]);

        $post = Post::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFileName = $image->getClientOriginalName() . '_' . time() . '.' .
                $image->getClientOriginalExtension();
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('/app/public/' . $imageFileName));
            $post->image = $imageFileName;
        };

        $post->post_title = $request->get('post_title');
        $post->post_data = $request->get('post_data');
        $post->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('auth');

        $post = Post::find($id);
        $post->delete();

        return redirect('/blog')->with('success', 'Post has been deleted Successfully');
    }
}
