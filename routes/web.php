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
Route::get('/auth/activate', 'Auth\ActivationController@activate')->name('auth.activate');
Route::get('/auth/activate/resend', 'Auth\ActivationController@showResendForm')->name('auth.activate.resend');
Route::post('/auth/activate/resend', 'Auth\ActivationController@resend');

Route::get('/', 'FrontController@index')->name('frontpage');
Route::get('/contact', 'FrontController@contact')->name('contact');
Route::post('/contact', 'FrontController@postContact');

Route::get('/families', 'FamilyController@index')->name('families');

Route::get('/genera', 'GenusController@index')->name('genera');
Route::get('/genera/show/{family}', 'GenusController@showFamilyGenera')->name('genera.family');
Route::get('/genus/{id}', 'GenusController@show')->name('genera.show');

Route::get('/species/show/{genus}', 'SpeciesController@showGenusSpecies')->name('species.genus');
Route::get('/species/wsc-lsid/{lsid}', 'SpeciesController@getByLsid')->name('specieslsid');
Route::get('/species/{species}/{region?}', 'SpeciesController@show')->name('species');

Route::get('/literature', 'LiteratureController@index')->name('literature');
Route::get('/literature/taxa/{paper}', 'LiteratureController@taxa')->name('literature.single.taxa');
Route::get('/literature/{paper}', 'LiteratureController@show')->name('literature.single');

Route::get('/taxon/search', 'SearchController@index')->name('taxon.search');
Route::post('/taxon/search', 'SearchController@show');

Route::get('/updates', 'FrontController@updates')->name('updates');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/empty', function(){
    $emptySpecies = [];
    $species =  App\Species::with('genus')->get();
    foreach($species as $s){
        if(!count($s->localities)){

            $emptySpecies[]= $s->genus->name . ' ' . $s->name;
        }
    }

    return $emptySpecies;
});

// Route::get('/wsc', function(\App\Services\WscService $wsc){
// 	$a = $wsc->fetchUpdatedTaxa('2017-07-01');
// 	dd($a);
// });

//Search routes
Route::post('/algolia/search-papers', 'Admin\AlgoliaController@selectPaper');

//Statistics
Route::get('/statistics/localities-by-country', 'Statistics\StatisticByCountryController@index')->name('stat.countries');
Route::get('/statistics/localities-by-country/{country}', 'Statistics\StatisticByCountryController@country')->name('stat.country');
Route::get('/statistics/localities-by-region', 'Statistics\StatisticByRegionController@localitiesByRegion')->name('stat.regions');
Route::get('/statistics/localities-by-region/{region}', 'Statistics\StatisticByRegionController@localitiesByRegionShow')->name('stat.region');
Route::post('/statistics/species-region-export', 'Statistics\StatisticByRegionController@export');

Route::get('/statistics/species-by-locality', 'Statistics\StatisticByLocalityController@index')->name('stat.locality');
Route::get('/statistics/species-by-locality/{locality}', 'Statistics\StatisticByLocalityController@locality')->name('stat.locality.single');
Route::post('/statistics/species-locality-export', 'Statistics\StatisticByLocalityController@export');
Route::get('/statistics/species-by-region', 'Statistics\StatisticByRegionController@index')->name('stat.region');
Route::get('/statistics/species-by-region/{region}', 'Statistics\StatisticByRegionController@region')->name('stat.region.single');

// Admin routes
// Middlewares applied on the controller level
Route::get('/admin', 'Admin\AdminController@index')->name('admin');

Route::get('/admin/authors', 'Admin\AuthorsController@index')->name('admin.authors');
Route::get('/admin/authors/create', 'Admin\AuthorsController@create')->name('admin.authors.create');
Route::get('/admin/authors/edit/{author}', 'Admin\AuthorsController@edit')->name('admin.authors.edit');
Route::post('/admin/authors/edit', 'Admin\AuthorsController@saveAuthor');
Route::post('/admin/authors/create', 'Admin\AuthorsController@save');

Route::get('/admin/papers', 'Admin\PapersController@index')->name('admin.papers');
Route::get('/admin/papers/create', 'Admin\PapersController@create')->name('admin.papers.create');
Route::post('/admin/papers/create', 'Admin\PapersController@save');
Route::get('/admin/papers/{paper}/edit', 'Admin\PapersController@edit')->name('admin.papers.edit');

Route::get('/admin/collections', 'Admin\CollectionController@index')->name('admin.collections');
Route::get('/admin/collections/create', 'Admin\CollectionController@create')->name('admin.collections.create');

Route::get('/admin/family', 'Admin\FamilyController@index')->name('admin.family');
Route::get('/admin/family/create', 'Admin\FamilyController@create')->name('admin.family.create');
Route::post('/admin/family/create', 'Admin\FamilyController@save');
Route::get('/admin/family/edit/{family}', 'Admin\FamilyController@edit')->name('admin.family.edit');
Route::post('/admin/family/edit', 'Admin\FamilyController@update');

Route::get('/admin/genus', 'Admin\GenusController@index')->name('admin.genus');
Route::get('/admin/genus/create', 'Admin\GenusController@create')->name('admin.genus.create');
Route::post('/admin/genus/create', 'Admin\GenusController@save');
Route::get('/admin/genus/edit/{genus}', 'Admin\GenusController@edit')->name('admin.genus.edit');
Route::post('/admin/genus/edit', 'Admin\GenusController@saveGenus');

Route::get('/admin/species', 'Admin\SpeciesController@index')->name('admin.species');
Route::get('/admin/species/create', 'Admin\SpeciesController@create')->name('admin.species.create');
Route::post('/admin/species/create', 'Admin\SpeciesController@save');
Route::post('/admin/species/create-by-lsid', 'Admin\SpeciesController@saveByLsid');
Route::get('/admin/species/edit/{species}', 'Admin\SpeciesController@edit')->name('admin.species.edit');
Route::post('/admin/species/edit', 'Admin\SpeciesController@saveSpecies');
Route::get('/admin/species/images', 'Admin\SpeciesController@images')->name('admin.species.images');
Route::post('/admin/species/images', 'Admin\SpeciesController@saveImage');
Route::get('/admin/species/delete/{species}', 'Admin\SpeciesController@delete')->name('admin.species.delete');
Route::post('/admin/species/delete', 'Admin\SpeciesController@destroy');

Route::get('/admin/countries', 'Admin\CountryController@index')->name('admin.country');
Route::get('/admin/countries/create', 'Admin\CountryController@create')->name('admin.country.create');
Route::post('/admin/countries/create', 'Admin\CountryController@save');
Route::get('/admin/country/edit/{country}', 'Admin\CountryController@edit')->name('admin.country.edit');
Route::post('/admin/country/edit', 'Admin\CountryController@saveCountry');

Route::get('/admin/regions', 'Admin\RegionController@index')->name('admin.region');
Route::get('/admin/regions/create', 'Admin\RegionController@create')->name('admin.region.create');
Route::post('/admin/regions/create', 'Admin\RegionController@save');
Route::get('/admin/region/edit/{region}', 'Admin\RegionController@edit')->name('admin.region.edit');
Route::post('/admin/region/edit', 'Admin\RegionController@saveRegion');

Route::get('/admin/localities', 'Admin\LocalityController@index')->name('admin.locality');
Route::get('/admin/locality/create', 'Admin\LocalityController@create')->name('admin.locality.create');
Route::post('/admin/locality/create', 'Admin\LocalityController@save');
Route::get('/admin/locality/edit/{locality}', 'Admin\LocalityController@edit')->name('admin.locality.edit');
Route::post('/admin/locality/edit', 'Admin\LocalityController@saveLocality');


Route::get('/admin/records', 'Admin\RecordController@index')->name('admin.record');
Route::get('/admin/records/create', 'Admin\RecordController@create')->name('admin.record.create');
Route::post('/admin/records/create', 'Admin\RecordController@save');
Route::get('/admin/records/edit/{record}', 'Admin\RecordController@edit')->name('admin.record.edit');
Route::post('/admin/records/edit', 'Admin\RecordController@update')->name('admin.record.update');

Route::post('/admin/records/search-species', 'Admin\RecordController@searchSpecies');
Route::post('/admin/records/search-localities', 'Admin\RecordController@searchLocalities');

Route::get('/admin/daily-updates', 'Admin\DailyUpdatesController@index')->name('admin.daily_updates');

Route::get('/admin/audit-logs', 'Admin\AuditLogsController@index')->name('admin.audit_logs');


//Admin Ajax routes
Route::post('/admin/ajax/fetch-countries-for-region', 'Admin\RecordController@fetchCountriesForRegion')->name('admin.ajax.countries-for-region');


