<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/menus', \App\Http\Controllers\MenuController::class);

Route::resource('/biodatas', \App\Http\Controllers\BiodataController::class);
