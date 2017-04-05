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

Route::get('/species/show/{genus}', 'SpeciesController@showGenusSpecies')->name('species.genus');
Route::get('/species/{species}', 'SpeciesController@show')->name('species');

Route::get('/literature', 'LiteratureController@index')->name('literature');
Route::get('/literature/{paper}', 'LiteratureController@show')->name('literature.single');

Route::get('/taxon/search', 'SearchController@index')->name('taxon.search');
Route::post('/taxon/search', 'SearchController@show');

Route::get('/home', 'HomeController@index')->name('home');

//Search routes
Route::post('/algolia/search-papers', 'Admin\AlgoliaController@selectPaper');

//Admin routes
Route::get('/admin', 'Admin\AdminController@index')->name('admin');

Route::get('/admin/authors', 'Admin\AuthorsController@index')->name('admin.authors');
Route::get('/admin/authors/create', 'Admin\AuthorsController@create')->name('admin.authors.create');
Route::get('/admin/authors/edit/{author}', 'Admin\AuthorsController@edit')->name('admin.authors.edit');
Route::post('/admin/authors/edit', 'Admin\AuthorsController@saveAuthor');
Route::post('/admin/authors/create', 'Admin\AuthorsController@save');

Route::get('/admin/papers', 'Admin\PapersController@index')->name('admin.papers');
Route::get('/admin/papers/create', 'Admin\PapersController@create')->name('admin.papers.create');
Route::post('/admin/papers/create', 'Admin\PapersController@save');

Route::get('/admin/family', 'Admin\FamilyController@index')->name('admin.family');
Route::get('/admin/family/create', 'Admin\FamilyController@create')->name('admin.family.create');
Route::post('/admin/family/create', 'Admin\FamilyController@save');
Route::get('/admin/family/edit/{family}', 'Admin\FamilyController@edit')->name('admin.family.edit');
Route::post('/admin/family/edit', 'Admin\FamilyController@saveFamily');

Route::get('/admin/genus', 'Admin\GenusController@index')->name('admin.genus');
Route::get('/admin/genus/create', 'Admin\GenusController@create')->name('admin.genus.create');
Route::post('/admin/genus/create', 'Admin\GenusController@save');
Route::get('/admin/genus/edit/{genus}', 'Admin\GenusController@edit')->name('admin.genus.edit');
Route::post('/admin/genus/edit', 'Admin\GenusController@saveGenus');

Route::get('/admin/species', 'Admin\SpeciesController@index')->name('admin.species');
Route::get('/admin/species/create', 'Admin\SpeciesController@create')->name('admin.species.create');
Route::post('/admin/species/create', 'Admin\SpeciesController@save');
Route::get('/admin/species/edit/{species}', 'Admin\SpeciesController@edit')->name('admin.species.edit');
Route::post('/admin/species/edit', 'Admin\SpeciesController@saveSpecies');

Route::get('/admin/countries', 'Admin\CountryController@index')->name('admin.country');
Route::get('/admin/countries/create', 'Admin\CountryController@create')->name('admin.country.create');
Route::post('/admin/countries/create', 'Admin\CountryController@save');
Route::get('/admin/country/edit/{country}', 'Admin\CountryController@edit')->name('admin.country.edit');
Route::post('/admin/country/edit', 'Admin\CountryController@saveCountry');

Route::get('/admin/regions', 'Admin\RegionController@index')->name('admin.region');
Route::get('/admin/regions/create', 'Admin\RegionController@create')->name('admin.region.create');
Route::post('/admin/regions/create', 'Admin\RegionController@save');
Route::get('/admin/region/edit/{region}', 'Admin\RegionController@edit')->name('admin.region.edit');
