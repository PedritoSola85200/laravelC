<?php

use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\postController;
use App\Http\Middleware\isAdmin;
use App\Models\post;
use Illuminate\Support\Facades\Route;


Route::get('/', function(){
    
    return view('admin.dashboard');
    
})/* ->middleware('admin') */ 
->name('dashboard');

route::resource('posts', postController::class)->middleware('can:admin');
Route::resource('categories', categoryController::class);
