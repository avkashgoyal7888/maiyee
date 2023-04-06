<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;

	Route::controller(HomeController::class)->group(function(){
		Route::get('/', 'index')->name('web.home');
		Route::get('/register', 'register')->name('web.register');
		Route::post('/register-submit', 'registerSubmit')->name('web.register.submit');
		Route::get('/disclaimer', 'disclaimer')->name('web.disclaimer');
		Route::get('/policy', 'policy')->name('web.policy');
		Route::get('/refund', 'refund')->name('web.refund');
		Route::get('/shipping', 'shipping')->name('web.shipping');
		Route::post('/login-submit', 'loginSubmit')->name('web.login.submit');
		Route::get('/logout', 'logOut')->name('web.logout');
	});



?>