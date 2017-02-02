<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
*/

//Basic route
Route::get('/', 'PropertyController@index');
Route::get('/index', 'PropertyController@index');

Route::get('import-property', 'PropertyImportController@index');
Route::post('property-save', 'PropertyImportController@save');
//Static URL Set
Route::get('property-save', 'PropertyImportController@index');

Route::post('property-search', 'PropertyController@search');
//Static URL Set
Route::get('property-search', 'PropertyController@index');
