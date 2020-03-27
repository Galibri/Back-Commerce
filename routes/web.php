<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

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
})->name('homepage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->namespace('Admin')->name('admin.')->group(function() {
    //All the admin routes will be defined here
    Route::match(['get', 'post'], '/', 'AdminController@login')->name('login');

    Route::group(['middleware' => ['admin']], function() {
        Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('/logout', 'AdminController@logout')->name('logout');
        Route::put('/profile/{admin}', 'AdminController@updateProfile')->name('update-profile');
        Route::get('/profile/{admin}', 'AdminController@profile')->name('profile');

        Route::resource('category', 'Category\CategoryController');
        // Route::resource('model', 'Model\ModelController');
    });
});