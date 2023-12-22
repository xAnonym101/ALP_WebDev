<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\VariantController;

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

Route::get('/home', function () {
    return view('home',
    [
        "pagetitle" => "home"
    ]);
});

Route::get('/about_us', function () {
    return view('about_us',
    [
        "pagetitle" => "about us"
    ]);
});

Route::get("/sale", [ProductController::class, 'saleproduct'])->name('sale');

Route::get("/best_seller", [ProductController::class, 'bestseller'])->name('bestseller');

Route::get("/products_details/{id}", [ProductController::class, 'productdetail'])->name('products_details');

Route::get("/all_products", [ProductController::class, 'allproducts'])->name('allproducts');

Route::get("/new_arrival", [ProductController::class, 'newarrival'])->name('newarrival');

Route::get('/', [ProductController::class, 'productsList'])->middleware('auth')->name('homepage');

Route::get('/createCategory', [CategoryController::class, 'create'])->middleware('auth')->name('createCategory');
Route::post('/storeCategory', [CategoryController::class, 'store'])->middleware('auth')->name('storeCategory');
Route::get('/updateCategory/{id}', [CategoryController::class, 'edit'])->middleware('auth')->name('updateCategory');
Route::put('/saveCategory/{id}', [CategoryController::class, 'update'])->middleware('auth')->name('saveCategory');
Route::delete('/deleteCategory/{id}', [CategoryController::class, 'destroy'])->middleware('auth')->name('deleteCategory');

Route::get('/createEvent', [EventController::class, 'create'])->middleware('auth')->name('createEvent');
Route::post('/storeEvent', [EventController::class, 'store'])->middleware('auth')->name('storeEvent');
Route::get('/updateEvent/{id}', [EventController::class, 'edit'])->middleware('auth')->name('updateEvent');
Route::put('/saveEvent/{id}', [EventController::class, 'update'])->middleware('auth')->name('saveEvent');
Route::delete('/deleteEvent/{id}', [EventController::class, 'destroy'])->middleware('auth')->name('deleteEvent');

Route::get('/createPhone', [PhoneController::class, 'create'])->middleware('auth')->name('createPhone');
Route::post('/storePhone', [PhoneController::class, 'store'])->middleware('auth')->name('storePhone');
Route::get('/updatePhone/{id}', [PhoneController::class, 'edit'])->middleware('auth')->name('updatePhone');
Route::put('/savePhone/{id}', [PhoneController::class, 'update'])->middleware('auth')->name('savePhone');
Route::delete('/deletePhone/{id}', [PhoneController::class, 'destroy'])->middleware('auth')->name('deletePhone');

Route::get('/createSocial', [SocialController::class, 'create'])->middleware('auth')->name('createSocial');
Route::post('/storeSocial', [SocialController::class, 'store'])->middleware('auth')->name('storeSocial');
Route::get('/updateSocial/{id}', [SocialController::class, 'edit'])->middleware('auth')->name('updateSocial');
Route::put('/saveSocial/{id}', [SocialController::class, 'update'])->middleware('auth')->name('saveSocial');
Route::delete('/deleteSocial/{id}', [SocialController::class, 'destroy'])->middleware('auth')->name('deleteSocial');


Route::get('/createProduct', [ProductController::class, 'create'])->middleware('auth')->name('createProduct');
Route::post('/storeProduct', [ProductController::class, 'store'])->middleware('auth')->name('storeProduct');
Route::get('/updateProduct/{id}', [ProductController::class, 'edit'])->middleware('auth')->name('updateProduct');
Route::put('/saveUpdate/{id}', [ProductController::class, 'update'])->middleware('auth')->name('saveUpdate');
Route::delete('/deleteProduct/{id}', [ProductController::class, 'destroy'])->middleware('auth')->name('deleteProduct');


Route::delete('/deleteImage/{id}', [ImageController::class, 'destroy'])->middleware('auth')->name('deleteImage');

// Route::delete('/deleteVariant/{id}', [VariantController::class, 'destroy'])->middleware('auth')->name('deleteVariant');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

