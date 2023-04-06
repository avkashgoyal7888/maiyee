<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;

	Route::controller(HomeController::class)->group(function(){
		Route::get('/', 'index')->name('web.home');
		Route::get('/register', 'register')->name('web.register');
		Route::post('/register-submit', 'registerSubmit')->name('web.register.submit');
	});



?>