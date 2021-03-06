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

Route::resource('/profiles', 'ProfileController');

Route::resource('/videos', 'VideoController')->names([
    'show' => 'video',
]);

Route::get('/videos/{video}/{file}', 'VideoController@getAsset');

Route::get('/audios', function () {
    return view('audio');
});

Route::get('/messages/create/{user}', [
    'as' => 'message.create',
    'uses' => 'MessageController@create'
]);
Route::resource('/messages', 'MessageController', ['except' => 'create'])->names([
    'show' => 'message',
]);

Route::get('/messages/{message}/{file}', 'MessageController@getAsset');

Route::get('/stats', function () {
    $videos = App\Video::orderBy('created_at', 'desc')->paginate(10);
    return view('stats')->with('videos', $videos);
});

Route::view('/ajax', 'ajax');
