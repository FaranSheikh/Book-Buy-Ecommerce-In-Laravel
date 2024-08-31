<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\site\IndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('site.index');
// });
Route::get('/', [IndexController::class, 'homePage'])->name('site.homepage');
Route::get('product/{id}', [IndexController::class, 'productDetail'])->name('site.product.detail');
Route::get('cart', [IndexController::class, 'cartView'])->name('site.cart');
Route::get('checkout', [IndexController::class, 'checkoutView'])->name('site.checkout');
Route::get('add-to-cart', [IndexController::class, 'addProductToCart'])->name('site.add-to-cart');
Route::get('calculate-cart-products', [IndexController::class, 'calculateCartProducts'])->name('calculate.add-to-cart');

