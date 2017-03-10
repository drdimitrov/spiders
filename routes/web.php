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
Auth::routes();


Route::get('/', 'FrontController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/literature', 'LiteratureController@index')->name('literature');
Route::get('/literature/{paper}', 'LiteratureController@show')->name('literature.single');

//Admin routes
Route::get('/admin', 'Admin\AdminController@index')->name('admin');
Route::get('/admin/authors', 'Admin\AuthorsController@index')->name('admin.authors');
Route::get('/admin/authors/create', 'Admin\AuthorsController@create')->name('admin.authors.create');
Route::post('/admin/authors/create', 'Admin\AuthorsController@save');
Route::get('/admin/papers', 'Admin\PapersController@index')->name('admin.papers');
Route::get('/admin/papers/create', 'Admin\PapersController@create')->name('admin.papers.create');
Route::post('/admin/papers/create', 'Admin\PapersController@save');
