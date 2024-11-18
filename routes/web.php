<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DashboardController;

Route::get('/',[AdminController::class,'register']);
Route::post('/register',[AdminController::class,'registeruser']);
Route::get('/login',[AdminController::class,'login']);
Route::post('/login',[AdminController::class,'checklogin'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/logout',[AdminController::class,'logout']);
