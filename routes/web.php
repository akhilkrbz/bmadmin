<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', [Admin::class, 'home'])->name('home');
Route::get('/', [Admin::class, 'home']);
