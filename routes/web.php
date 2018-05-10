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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/terms', function () {
    return response('<h1>Terms of Service</h1>');
});

Auth::routes();

Route::resource('/profile', 'ProfileController');

Route::resource('/video', 'VideoController');

Route::get('/video/{video}/{file}', 'VideoController@getAsset')
    ->where('file', '(.*)');

Route::get('/audio', function () {
    return view('audio');
});

Route::get('/message/create/{user}', [
    'as' => 'message.create',
    'uses' => 'MessageController@create'
]);
Route::resource('/message', 'MessageController', ['except' => 'create']);

Route::get('/stats', function () {
    $videos = App\Video::orderBy('created_at', 'desc')->paginate(10);
    return view('stats')->with('videos', $videos);
});
