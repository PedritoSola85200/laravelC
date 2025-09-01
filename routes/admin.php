<?php

use App\Http\Controllers\admin\categoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){

    return view('admin.dashboard');

})->name('dashboard');

Route::resource('categories', categoryController::class);

