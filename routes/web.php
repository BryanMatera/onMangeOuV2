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


Route::get('recherche', 'rechercheController@selectionCategorie');
Route::post('traitement', 'rechercheController@resultatFormulaire');

Route::get('resultats/{id}/{codeP}',['as'=>'resultats','uses'=>'rechercheController@restoParCategorieEtCP']);

Route::get('resultats-categorie/{id}',['as'=>'resultats-categorie','uses'=>'rechercheController@restoParCategorie']);
