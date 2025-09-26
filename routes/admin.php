<?php

use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\postController;
use App\Models\post;
use Illuminate\Support\Facades\Route;


Route::get('/', function(){
    
    return view('admin.prueba');
    
})/* ->middleware('admin') */ 
->name('dashboard');

route::resource('posts', postController::class);
Route::resource('categories', categoryController::class)
->middleware('admin');
