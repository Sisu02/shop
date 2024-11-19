<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CategoryController;

Route::get('/register',[AdminController::class,'register']);
Route::post('/register',[AdminController::class,'registeruser']);
Route::get('/login',[AdminController::class,'login']);
Route::post('/login',[AdminController::class,'checklogin'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/logout',[AdminController::class,'logout']);
Route::get('/categories', [CategoryController::class, 'getcategory'])->name('categories');
Route::get('/addcategory', [CategoryController::class, 'addcategory']);
Route::get('/subcategories', [CategoryController::class, 'getsubcategory'])->name('subcategories');
Route::post('/addcat',[CategoryController::class, 'addcate']);
