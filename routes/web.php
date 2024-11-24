<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Middleware\LoginCheck;

Route::get('/register',[AdminController::class,'register']);
Route::post('/register',[AdminController::class,'registeruser']);
Route::get('/login',[AdminController::class,'login']);
Route::post('/login',[AdminController::class,'checklogin'])->name('login');

Route::middleware([LoginCheck::class])->group(function(){
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/logout',[AdminController::class,'logout']);
Route::get('/categories', [CategoryController::class, 'getcategory'])->name('categories');
Route::get('/addcategory', [CategoryController::class, 'addcategory']);
Route::get('/subcategories', [CategoryController::class, 'getsubcategory'])->name('subcategories');
Route::post('/addcat',[CategoryController::class, 'addcate']);


Route::get('/editcategory/{id}', [CategoryController::class, 'editcategory'])->name('editcategory');
Route::post('/updatecategory/{id}', [CategoryController::class, 'updatecategory'])->name('updatecategory');

Route::delete('/deletecategory/{id}', [CategoryController::class, 'deletecategory'])->name('deletecategory');

Route::get('/addsubcategory', [CategoryController::class, 'addsubcategory'])->name('addsubcategory');
Route::post('/addsubcat', [CategoryController::class, 'addsubcat']);

Route::get('/editsubcategory/{id}', [CategoryController::class, 'editsubcategory'])->name('editsubcategory');
Route::post('/updatesubcategory/{id}', [CategoryController::class, 'updatesubcategory'])->name('updatesubcategory');
Route::delete('/deletesubcategory/{id}', [CategoryController::class, 'deletesubcategory'])->name('deletesubcategory');

Route::get('/products', [ProductController::class, 'getproducts'])->name('products');
Route::get('/addproducts', [ProductController::class, 'addproducts'])->name('addproducts');


Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubcategories']);
Route::post('/addproduct',[ProductController::class,'addproduct']);

Route::delete('/deleteproduct/{id}',[ProductController::class,'deleteproduct']);
Route::get('/editproduct/{id}',[ProductController::class,'editproduct']);

});



