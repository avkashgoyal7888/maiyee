<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\HomeController;

	Route::get('/login', [AdminController::class, 'index'])->name('admin.login');
	Route::post('/login-submit', [AdminController::class, 'loginSubmit'])->name('admin.login.submit');
	Route::group(['middleware'=>'admin_middle'], function() {
	Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
	Route::post('/change-password', [AdminController::class, 'changePassword'])->name('admin.change.password');
	Route::post('/update-image', [AdminController::class, 'updateImage'])->name('admin.update.image');
	Route::get('/logout', [AdminController::class, 'logOut'])->name('admin.logout');
	Route::get('/delete-expired-coupons', [AdminController::class, 'deleteExpiredCoupons'])->name('delete_expired_coupons');

	Route::controller(HomeController::class)->group(function(){
		Route::post('/nav-edit', 'navEdit')->name('admin.nav.edit');
	});
	// state routes
	Route::get('/states', function(){ return view('admin.state.index'); })->name('admin.state');
	// city routes
	Route::get('/city', function() { return view('admin.city.index'); })->name('admin.city');
	//suppliers route
	Route::get('/supplier', function() { return view('admin.supplier.index'); })->name('admin.supplier');
	Route::get('/supplier-account/{id}', function() { return view('admin.supplier.account'); })->name('admin.supplier.account');
	// category routes
	Route::get('/category', function(){ return view('admin.category.index'); })->name('admin.category');
	// subcategory routes
	Route::get('/sub-category', function(){ return view('admin.subcategory.index'); })->name('admin.subcategory');
	// products route
	Route::get('/product', function(){ return view('admin.product.index'); })->name('admin.product');
	// color route
	Route::get('/color', function(){ return view('admin.color.index'); })->name('admin.color');
	Route::get('/color-image', function(){ return view('admin.color.image'); })->name('admin.color.image');
	// size routes
	Route::get('/sizes', function(){ return view('admin.size.index'); })->name('admin.size');
	// accounts route
	Route::get('/account', function(){ return view('admin.account.index'); })->name('admin.account');
	Route::get('/account-statement/{id}', function() { return view('admin.account.statement'); })->name('admin.account.statement');
	// banner routes
	Route::get('/banner', function(){ return view('admin.banner.index'); })->name('admin.banner');
	Route::get('/home-banner', function(){ return view('admin.banner.home'); })->name('admin.home.banner');
	// Coupon routes
	Route::get('/coupon', function(){ return view('admin.coupon.index'); })->name('admin.coupon');
	// Product Detail Routes
	Route::get('/product-detail', function(){ return view('admin.product.detail'); })->name('admin.product.detail');
	// Exhibition Routes
	Route::get('/exhibition', function(){ return view('admin.exhibition.index'); })->name('admin.exhibition');
	// Bash Routes
	Route::get('/bash', function(){ return view('admin.bash.index'); })->name('admin.bash');
	Route::get('/bash-product', function(){ return view('admin.bash.product'); })->name('admin.bash.product');
	// Order Routes
	Route::get('/order', function(){ return view('admin.order.index'); })->name('admin.order');
	Route::get('/order-detail/{id}', function() { return view('admin.order.detail'); })->name('admin.order.detail');
	// User Routes
	Route::get('/users', function(){ return view('admin.user.index'); })->name('admin.user');
	Route::get('/user-address/{id}', function(){ return view('admin.user.address'); })->name('admin.address');
	Route::get('/inventory', function(){ return view('admin.inventory.index'); })->name('admin.inventory');
	Route::get('/return', function(){ return view('admin.exchange.return'); })->name('admin.return');
	Route::get('/replace', function(){ return view('admin.exchange.replace'); })->name('admin.replace');
});



?>