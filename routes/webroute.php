<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;

	Route::controller(HomeController::class)->group(function(){
		Route::get('/', 'index')->name('web.home');
	});



?>