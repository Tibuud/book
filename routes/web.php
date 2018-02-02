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

// page d'accueil
Route::get('/', 'FrontController@index');
// route pour afficher un livre, route sécurisée
Route::get('book/{id}', 'FrontController@show')->where(['id' => '[0-9]+']);
// Route vers la page author
// Route::get('author/{id}', 'FrontController@showBookByAuthor')->where(['id' => '[0-9]+']);
Route::get('author/{id}', 'FrontController@showBookByAuthor');
// Route vers la page genre
Route::get('genre/{id}', 'FrontController@showBookByGenre')->where(['id' => '[0-9]+']);
//Route pour envoyer le formulaire
Route::post('votez/quiz', 'FrontController@create')->name('vote');
// Route vers les auteurs publiés
Route::get('authorPublished', 'FrontController@showByPublishedAuthor')->name('PublishedAuthor');


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin/book', 'BookController')->middleware('auth');
