<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\CartController;
use App\Http\Controllers\home\CheckOutController;

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
		Route::controller(HomeController::class)->group(function(){
			Route::get('/cart', 'cart')->name('web.cart');
			Route::get('/logout', 'logOut')->name('web.logout');
		});
		Route::controller(CartController::class)->group(function(){
		Route::post('/add-to-cart', 'addToCart')->name('web.add.cart');
		Route::post('/cart-to-cart', 'cartDelete')->name('web.delete.cart');
		Route::post('/cart-quantity-edit', 'cartEdit')->name('edit.cart');
		});
		Route::controller(CheckOutController::class)->group(function(){
			Route::get('/checkout','index')->name('web.checkout');
			Route::post('/apply-coupon', 'applyCoupon')->name('web.apply.coupon');
		});
	});



?>