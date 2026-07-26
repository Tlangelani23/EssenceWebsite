<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'home']);

Route::get('/catalog', [ProductController::class, 'catalog']);