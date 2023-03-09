<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::resource('invoices', 'InvoiceController');
Route::get('/section/{id}','InvoiceController@getProducts');
Route::resource('sections', 'SectionController');
Route::resource('products', 'ProductController');
Route::get("/{page}",'AdminController@index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
