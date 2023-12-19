<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\EventController;
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


Route::get('/createProduct', [ProductController::class, 'create'])->middleware('auth')->name('createProduct');
Route::post('/storeProduct', [ProductController::class, 'store'])->middleware('auth')->name('storeProduct');
Route::get('/updateProduct/{id}', [ProductController::class, 'edit'])->middleware('auth')->name('updateProduct');
Route::put('/saveUpdate/{id}', [ProductController::class, 'update'])->middleware('auth')->name('saveUpdate');
Route::delete('/deleteProduct/{id}', [ProductController::class, 'destroy'])->middleware('auth')->name('deleteProduct');

Route::delete('/deleteImage/{id}', [ImageController::class, 'destroy'])->middleware('auth')->name('deleteImage');

// Route::delete('/deleteVariant/{id}', [VariantController::class, 'destroy'])->middleware('auth')->name('deleteVariant');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

