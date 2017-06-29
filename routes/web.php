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

// Authentication Routes...
	$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
	$this->post('login', 'Auth\LoginController@login');
	$this->post('logout', 'Auth\LoginController@logout')->name('logout');

	// Registration Routes...
	$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	$this->post('register', 'Auth\RegisterController@register');

	// Password Reset Routes...
	$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

// Pages
	Route::post('content-management/pages/{page}/add-collaborators', 'PageController@addCollaborators')->name('pages.add_collaborators');
	Route::resource('content-management/pages', 'PageController');

// Users
	Route::get('content-management/users/{user}/restore', 'UserController@restore')->name('users.restore');
	Route::resource('content-management/users', 'UserController');

// Utilities
	Route::post('content-management/upload-image', 'UtilityController@uploadImage')->name('utilities.upload_image');
	Route::post('content-management/spell-check', 'UtilityController@spellCheck')->name('utilities.spell_check');

// Content

	// Route to preview a page
	Route::get('preview/{url_path}', [
	    'uses' => 'PageController@showPagePreview' 
	])->where('url_path', '([A-Za-z0-9\-\/]+)')->name('pages.preview');

    // Can use this if we want each page to use the same template.
	Route::get('{url_path}', [
	    'uses' => 'PageController@showPage' 
	])->where('url_path', '([A-Za-z0-9\-\/]+)')->name('pages.show_public');

    // Can use this is we want each page to have it's own file.
	// Route::get('{url_path}', [
	//     'uses' => 'PageController@getPage' 
	// ])->where('url_path', '([A-Za-z0-9\-\/]+)');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
