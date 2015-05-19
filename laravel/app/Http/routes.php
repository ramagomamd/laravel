<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get("files", [
	"as" => "files.index",
	"uses" => "FilesController@index"
]);
Route::get("files/create", [
	"as" => "files.create",
	"uses" => "FilesController@create"
]);
Route::post("files", [
	"as" => "files.store",
	"uses" => "FilesController@store"
]);
Route::get("files/{filename}/show", [
	"as" => "files.show",
	"uses" => "FilesController@show"
]);
Route::get("files/{filename}/edit", [
	"as" => "files.edit",
	"uses" => "FilesController@edit"
]);
Route::post("files/{filename}/update", [
	"as" => "files.update",
	"uses" => "FilesController@update"
]);
Route::get("files/{filename}/delete", [
	"as" => "files.destroy",
	"uses" => "FilesController@destroy"
]);
Route:resource("test", "TestController");