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

Route::get('/', function(){
  return view('welcome');
});

Route::post('/questionnaire_save', 'QuestionnaireController@store')->name('save_q');
Route::post('/getAccess', 'QuestionnaireController@SendQuestionnaire')->name('getAccess');
Route::get('/cuestionario/{token}', 'QuestionnaireController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/respuestas', 'Admin\FormController@index')->name('view_index_q');
Route::get('/respuestas/{id}', 'Admin\FormController@show')->name('view_questionnaire');


Route::get('/instituciones', 'Admin\InstitutionController@index')->name('institutions.index');
Route::post('/instituciones/store', 'Admin\InstitutionController@store')->name('institutions.store');

Route::get('/cursos', 'Admin\CourseController@index')->name('courses.index');
Route::post('/cursos/store', 'Admin\CourseController@store')->name('courses.store');

Route::get('/forms/edit/{id}', 'Admin\FormController@update');
