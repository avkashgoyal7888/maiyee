<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\CartController;
use App\Http\Controllers\home\CheckOutController;
use App\Http\Controllers\home\ForgetPasswordController;
use App\Http\Controllers\home\ReviewController;
use App\Http\Controllers\home\ShiprocketController;
use App\Http\Controllers\home\PaymentController;
use App\Http\Controllers\home\OrderController;
use App\Http\Controllers\home\FilterController;
use App\Http\Controllers\home\LinkController;
use Illuminate\Http\Request;
	Route::controller(HomeController::class)->group(function(){
		Route::get('/', 'index')->name('web.home');
		Route::get('/register', 'register')->name('web.register');
		Route::post('/register-submit', 'registerSubmit')->name('web.register.submit');
		Route::post('/store-generated-otp', function (Request $request) {
    		$request->session()->put('generatedOTP', $request->otp);
    		return response()->json(['status' => 200]);
		})->name('store.generated.otp');
		Route::post('/send-sms', 'sendSMS')->name('send-sms');
		Route::post('/check-phone-number', 'checkPhoneNumber')->name('check-phone-number');
		Route::get('/disclaimer', 'disclaimer')->name('web.disclaimer');
		Route::get('/about-us', 'about')->name('web.about');
		Route::get('/policy', 'policy')->name('web.policy');
		Route::get('/exhibition', 'exhibition')->name('web.exhibition');
		Route::get('/wardrobe', 'wardrobe')->name('web.wardrobe');
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
		Route::get('/product/{id}', 'getProductData')->name('web.product.data');
	});

	Route::controller(FilterController::class)->group(function(){
		Route::get('/filterbypricecat','filterByPriceCat')->name('filter.by.price.cat');
		Route::get('/filterbypricesub','filterByPriceSub')->name('filter.by.price.sub');
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
		Route::controller(PaymentController::class)->group(function(){
			Route::any('/pay', 'pay')->name('payment.pay');
			Route::any('/order-success', 'orderSuccess')->name('web.success');
			Route::any('/order-fail', 'orderFail')->name('web.fail');
			Route::any('/order-cancel', 'orderCancel')->name('web.cancel');
			Route::get('/order-successful', 'orderCOD')->name('order.cod');
		});
		Route::controller(OrderController::class)->group(function(){
			Route::get('/orders', 'orders')->name('web.orders');
			Route::post('/return', 'returnOrReplace')->name('web.order.submit');
		});

		Route::post('/order/create', [ShiprocketController::class, 'createOrder'])->name('web.order.create');
		Route::post('/buy-order', [ShiprocketController::class, 'buyOrder'])->name('web.buy.create');
		Route::controller(HomeController::class)->group(function(){
			Route::get('/cart', 'cart')->name('web.cart');
			Route::get('/wish', 'wish')->name('web.wish');
			Route::get('/logout', 'logOut')->name('web.logout');
		});
		Route::controller(CartController::class)->group(function(){
		Route::post('/add-to-cart', 'addToCart')->name('web.add.cart');
		Route::post('/buy-now', 'buyNow')->name('web.buy.now');
		Route::post('/cart-to-cart', 'cartDelete')->name('web.delete.cart');
		Route::post('/cart-quantity-edit', 'cartEdit')->name('edit.cart');
		Route::post('/add-to-wish', 'addToWishList')->name('web.add.wishlist');
		Route::post('/delete-wish', 'wishDelete')->name('web.delete.wish');
		});
		Route::controller(CheckOutController::class)->group(function(){
			Route::get('/checkout','index')->name('web.checkout');
			Route::get('/buy', 'buyView')->name('web.check.buy');
			Route::get('/address', 'addressView')->name('web.address');
			Route::post('/address-submit', 'addressSubmit')->name('web.address.submit');
			Route::post('/apply-coupon', 'applyCoupon')->name('web.apply.coupon');
			Route::post('/apply-coupon-buy', 'applyCouponBuy')->name('web.apply.coupon.buy');
			Route::get('/download-pdf', 'download')->name('download');
		});
	});

	Route::controller(LinkController::class)->group(function(){
		Route::get('/link-product', 'index')->name('link.home');
		Route::get('/order-placed', 'orderPlaced')->name('link.order.placed');
		Route::get('/link-user/{id}','linkUserView')->name('link.user.view');
		Route::get('/user-products/{id}','linkUserProductView')->name('link.user.product.view');
		Route::post('/session', 'storeSelectedProducts')->name('store.product.session');
		Route::get('/session-data', 'sessionData');
		Route::get('/clear','clearSelectedProducts');
		Route::post('/link-user-submit','linkUserSubmit')->name('link.user.submit');
		Route::get('/qrcode','generate');
	});



?>