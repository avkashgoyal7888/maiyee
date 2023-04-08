<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

	Route::get('/login', [AdminController::class, 'index'])->name('admin.login');
	Route::post('/login-submit', [AdminController::class, 'loginSubmit'])->name('admin.login.submit');
	Route::group(['middleware'=>'admin_middle'], function() {
	Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
	Route::post('/change-password', [AdminController::class, 'changePassword'])->name('admin.change.password');
	Route::post('/update-image', [AdminController::class, 'updateImage'])->name('admin.update.image');
	Route::get('/logout', [AdminController::class, 'logOut'])->name('admin.logout');
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
	// size routes
	Route::get('/sizes', function(){ return view('admin.size.index'); })->name('admin.size');
	// accounts route
	Route::get('/account', function(){ return view('admin.account.index'); })->name('admin.account');
	Route::get('/account-statement/{id}', function() { return view('admin.account.statement'); })->name('admin.account.statement');
	// banner routes
	Route::get('/banner', function(){ return view('admin.banner.index'); })->name('admin.banner');
});



?>