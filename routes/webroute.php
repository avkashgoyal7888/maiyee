<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\CartController;

	Route::controller(HomeController::class)->group(function(){
		Route::get('/', 'index')->name('web.home');
		Route::get('/register', 'register')->name('web.register');
		Route::post('/register-submit', 'registerSubmit')->name('web.register.submit');
		Route::get('/disclaimer', 'disclaimer')->name('web.disclaimer');
		Route::get('/policy', 'policy')->name('web.policy');
		Route::get('/refund', 'refund')->name('web.refund');
		Route::get('/shipping', 'shipping')->name('web.shipping');
		Route::get('/product-detail/{id}', 'productDetail')->name('web.product.detail');
		Route::post('/login-submit', 'loginSubmit')->name('web.login.submit');
		
	});

	Route::group(['middleware'=>'auth'], function() {
		Route::get('/cart', [HomeController::class, 'cart'])->name('web.cart');
		Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('web.add.cart');
		Route::post('/cart-to-cart', [CartController::class, 'cartDelete'])->name('web.delete.cart');
		Route::post('/cart-quantity-edit', [CartController::class, 'cartEdit'])->name('edit.cart');
		Route::get('/logout', [HomeController::class, 'logOut'])->name('web.logout');
	});



?>