<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RazorpayController;

Route::redirect('/', '/dashboard');
Route::get('/signup', [UserController::class, 'showSignupPage'])->name('signup');
Route::get('/login', [UserController::class, 'showLoginPage'])->name('login');
Route::post('/signup', [UserController::class, 'handleSignup'])->name('handleSignup');
Route::post('/login', [UserController::class, 'handleLogin'])->name('handleLogin');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/profile',[UserController::class,'profile'])->name('profile');
Route::get('/verify-email/{encodedId}', [UserController::class, 'verifyEmail'])->name('verify-email');

Route::get('/add-product', [FarmerController::class, 'showAddProductForm'])->name('addProduct');
Route::post('/add-product', [FarmerController::class, 'handleAddProduct'])->name('handleAddProduct');
Route::get('/products', [FarmerController::class, 'showProductList'])->name('products');
Route::delete('/products/{id}', [FarmerController::class, 'deleteProduct'])->name('deleteProduct');
Route::get('/products/{id}/edit', [FarmerController::class, 'editProductForm'])->name('editProduct');
Route::put('/products/{id}', [FarmerController::class, 'updateProduct'])->name('updateProduct');


Route::get('/f/orders', [FarmerController::class, 'showOrders'])->name('orders');
Route::post('/f/orders/{id}/accept', [FarmerController::class, 'acceptOrder'])->name('acceptOrder');
Route::post('/f/orders/{id}/reject', [FarmerController::class, 'rejectOrder'])->name('rejectOrder');

Route::post('/f/orders/{id}/counter', [FarmerController::class, 'counterOffer'])->name('makecounterOffer');
Route::get('/f/setcounter/{id}', [FarmerController::class, 'showcounterOfferForm'])->name('showcounterOfferForm');



Route::get('/dashboard', [BuyerController::class, 'showDashboard'])->name('dashboard');
Route::get('/productdetail/{id}', [BuyerController::class, 'showProductDetails'])->name('productDetails');
Route::get('/orders', [BuyerController::class, 'showOrders'])->name('orders');
Route::get('/orders/{id}', [BuyerController::class, 'showOrderDetails'])->name('orderDetails');
Route::post('/orders/{id}/cancel', [BuyerController::class, 'cancelOrder'])->name('cancelOrder');


Route::get('/search', [BuyerController::class, 'searchProducts'])->name('searchProducts');




Route::get('/checkout/{product_id}', [OrderController::class, 'showCheckoutForm'])->name('checkout');
Route::post('/checkout/{product_id}', [OrderController::class, 'handleCheckout'])->name('handleCheckout');

Route::post('/razorpay-payment', [RazorpayController::class, 'store'])->name('razorpay.store');



