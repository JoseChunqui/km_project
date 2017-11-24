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

Route::get('/getAccess', function(){
  return view('welcome');
});

Route::post('/questionnaire_save', 'QuestionnaireController@store')->name('save_q');
Route::post('/getAccess', 'QuestionnaireController@SendQuestionnaire')->name('getAccess');
Route::get('/cuestionario/{token}', 'QuestionnaireController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

  Route::post('/forms/edit/{id}', 'Admin\FormController@update');
  Route::get('/cuestionarios', 'Admin\FormController@index')->name('forms.index');
  Route::post('/cuestionarios/store', 'Admin\FormController@store')->name('forms.store');
  Route::post('/cuestionarios/manage', 'Admin\FormController@manage')->name('forms.manage');
  Route::post('/cuestionarios/estado', 'Admin\FormController@changeState')->name('forms.changeState');

  Route::get('/respuestas', 'Admin\QuestionnaireController@index')->name('answers.index');
  Route::post('/respuestas', 'Admin\QuestionnaireController@export_to_excel')->name('answers.export_to_excel');
  Route::get('/respuesta', 'Admin\QuestionnaireController@show')->name('answers.show');

});

Route::group(['middleware' => ['auth','admin']], function(){
  //Manage Users
  Route::get('/docentes', 'Admin\UserController@index')->name('users.index');
  Route::post('/docentes/store', 'Admin\UserController@store')->name('users.store');

  //Manage institutions
  Route::get('/instituciones', 'Admin\InstitutionController@index')->name('institutions.index');
  Route::post('/instituciones/store', 'Admin\InstitutionController@store')->name('institutions.store');

  //Manage Courses
  Route::get('/cursos', 'Admin\CourseController@index')->name('courses.index');
  Route::post('/cursos/store', 'Admin\CourseController@store')->name('courses.store');
});
