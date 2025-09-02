<?php

use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\postController;
use App\Models\post;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){

    return view('admin.dashboard');

})->name('dashboard');

Route::resource('categories', categoryController::class);

route::resource('posts', postController::class);