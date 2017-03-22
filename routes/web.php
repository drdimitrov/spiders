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


Route::get('/', 'FrontController@index')->name('frontpage');
Route::get('/contact', 'FrontController@contact')->name('contact');
Route::post('/contact', 'FrontController@postContact');

Route::get('/families', 'FamilyController@index')->name('families');

Route::get('/genera', 'GenusController@index')->name('genera');
Route::get('/genera/show/{family}', 'GenusController@showFamilyGenera')->name('genera.family');
Route::get('/genus/{id}', 'GenusController@show')->name('genera.show');

Route::get('/species', 'SpeciesController@index')->name('species');
Route::get('/species/show/{genus}', 'SpeciesController@showGenusSpecies')->name('species.genus');


Route::get('/literature', 'LiteratureController@index')->name('literature');
Route::get('/literature/{paper}', 'LiteratureController@show')->name('literature.single');

Route::get('/home', 'HomeController@index')->name('home');

//Search routes
Route::post('/algolia/search-papers', 'Admin\AlgoliaController@selectPaper');

//Admin routes
Route::get('/admin', 'Admin\AdminController@index')->name('admin');

Route::get('/admin/authors', 'Admin\AuthorsController@index')->name('admin.authors');
Route::get('/admin/authors/create', 'Admin\AuthorsController@create')->name('admin.authors.create');
Route::post('/admin/authors/create', 'Admin\AuthorsController@save');

Route::get('/admin/papers', 'Admin\PapersController@index')->name('admin.papers');
Route::get('/admin/papers/create', 'Admin\PapersController@create')->name('admin.papers.create');
Route::post('/admin/papers/create', 'Admin\PapersController@save');

Route::get('/admin/family/create', 'Admin\FamilyController@create')->name('admin.family.create');
Route::post('/admin/family/create', 'Admin\FamilyController@save');

Route::get('/admin/genus/create', 'Admin\GenusController@create')->name('admin.genus.create');
Route::post('/admin/genus/create', 'Admin\GenusController@save');

Route::get('/admin/species/create', 'Admin\SpeciesController@create')->name('admin.species.create');
Route::post('/admin/species/create', 'Admin\SpeciesController@save');