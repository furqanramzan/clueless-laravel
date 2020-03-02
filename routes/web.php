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

Route::name('guest.')->group(function () {
    Route::get('/', 'GuestController@index')->name('index');
    Route::get('review/{id}', 'GuestController@review')->name('review');
    Route::get('toplist/{id}', 'GuestController@toplist')->name('toplist');
    Route::get('find', 'GuestController@find')->name('find');
    Route::get('contact', 'GuestController@contact')->name('contact');
    Route::post('comment/{id}', 'GuestController@comment')->name('comment');
});

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Auth::routes(['register' => false, 'reset' => false]);
    Route::get('/', 'DashboardController@redirect');

    Route::middleware('auth')->group(function () {
        // Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('admin', 'AdminController')->except('show');
        Route::post('review/{id}/publish', 'ReviewController@publish')->name('review.publish');
        Route::resource('review', 'ReviewController');
        Route::resource('reviewcomment', 'ReviewCommentController')->except('index', 'create', 'store');
        Route::resource('toplist', 'TopListController')->except('show');
        Route::resource('toplistreview', 'TopListReviewController')->except('show');
        Route::resource('setting', 'SettingController')->only('edit', 'update');
    });
});
