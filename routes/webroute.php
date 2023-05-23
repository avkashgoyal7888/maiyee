<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\CartController;
use App\Http\Controllers\home\CheckOutController;
use App\Http\Controllers\home\ForgetPasswordController;
use App\Http\Controllers\home\ReviewController;
use App\Http\Controllers\home\ShiprocketController;
use App\Http\Controllers\home\PaymentController;
use Illuminate\Http\Request;
	Route::controller(HomeController::class)->group(function(){
		Route::get('/', 'index')->name('web.home');
		Route::get('/register', 'register')->name('web.register');
		Route::post('/register-submit', 'registerSubmit')->name('web.register.submit');

Route::post('/store-generated-otp', function (Request $request) {
    $request->session()->put('generatedOTP', $request->otp);
    return response()->json(['status' => 200]);
})->name('store.generated.otp');
// routes/web.php

Route::post('/send-sms', 'sendSMS')->name('send-sms');


		Route::get('/disclaimer', 'disclaimer')->name('web.disclaimer');
		Route::get('/policy', 'policy')->name('web.policy');
		Route::get('/exhibition', 'exhibition')->name('web.exhibition');
		Route::get('/refund', 'refund')->name('web.refund');
		Route::get('/shipping', 'shipping')->name('web.shipping');
		Route::get('/product-detail/{id}', 'productDetail')->name('web.product.detail');
		Route::post('/login-submit', 'loginSubmit')->name('web.login.submit');
		Route::get('/auth/google','redirectToGoogle')->name('auth.google.redirect');
		Route::get('/auth/google/callback','handleGoogleCallback');
		Route::get('/auth/facebook', 'redirectToFacebook')->name('auth.facebook.redirect');
		Route::get('/auth/facebook/callback', 'handleFacebookCallback');
		Route::get('/sub-category/{id}', 'subcategory')->name('front.sub');
		Route::get('/category/{id}', 'category')->name('front.cat');
		Route::get('/filterbyprice','filterByPrice')->name('filter.by.price');
		Route::get('/filter-by-size','filterBySize')->name('filter.by.size');
		Route::get('/filter-by-color','filterByColor')->name('filter.by.color');
		Route::get('/product/{id}', 'getProductData')->name('web.product.data');

	});

	Route::controller(ForgetPasswordController::class)->group(function(){
		Route::get('/forget-password', 'index')->name('web.forget');
		Route::post('/forget-password-submit', 'ForgetPasswordSubmit')->name('web.forget.submit');
		Route::get('/otp-view', 'otpView')->name('web.otp.view');
		Route::post('/verify-otp', 'otpVerify')->name('web.verify.otp');
		Route::get('/reset-view', 'resetPasswordView')->name('web.reset.view');
		Route::post('/reset-password-submit', 'resertPassword')->name('reset.password.submit');
	});

	Route::post('/review-submit', [ReviewController::class, 'reviewSubmit'])->name('web.review.submit');

	Route::group(['middleware'=>'auth'], function() {
		Route::any('/pay', [PaymentController::class, 'pay'])->name('payment.pay');

		Route::post('/order/create', [ShiprocketController::class, 'createOrder'])->name('web.order.create');
		Route::controller(HomeController::class)->group(function(){
			Route::get('/cart', 'cart')->name('web.cart');
			Route::get('/wish', 'wish')->name('web.wish');
			Route::any('/order-success', 'orderSuccess')->name('web.success');
			Route::any('/order-fail', 'orderFail')->name('web.fail');
			Route::any('/order-cancel', 'orderCancel')->name('web.cancel');
			Route::get('/orders', 'orders')->name('web.orders');
			Route::get('/logout', 'logOut')->name('web.logout');
		});
		Route::controller(CartController::class)->group(function(){
		Route::post('/add-to-cart', 'addToCart')->name('web.add.cart');
		Route::post('/cart-to-cart', 'cartDelete')->name('web.delete.cart');
		Route::post('/cart-quantity-edit', 'cartEdit')->name('edit.cart');
		Route::post('/add-to-wish', 'addToWishList')->name('web.add.wishlist');
		});
		Route::controller(CheckOutController::class)->group(function(){
			Route::get('/checkout','index')->name('web.checkout');
			Route::post('/apply-coupon', 'applyCoupon')->name('web.apply.coupon');
		});
	});



?>