<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/blog', 'PostController@index')->name('blog');
Route::get('/blog/create', 'PostController@create')->name('post.create');
Route::post('/blog/store', 'PostController@store')->name('blog-store');
Route::put('/blog/update/{id}', 'PostController@update')->name('post.update');

Route::get('/blog/post/{id}', 'PostController@show')->name('post.show');
Route::get('/blog/edit/{id}', 'PostController@edit')->name('post.edit');
Route::post('/comment/store', 'CommentController@store')->name('comment.store');

Route::get('storage/{filename}', function ($filename) {
    $path = storage_path('public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});