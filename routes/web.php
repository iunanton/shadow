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

Route::get('/terms', function () {
    return response('<h1>Terms of Service</h1>');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/video', 'VideoController');

Route::get('/video/{video}/{file}', 'VideoController@getAsset')
    ->where('file', '(.*)');

Route::get('/stats', function () {
    $videos = App\Video::paginate(15);
    return view('stats')->with('videos', $videos);
});
