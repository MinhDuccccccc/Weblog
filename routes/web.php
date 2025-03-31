<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController; // Thêm dòng này

Route::get('/', function () {
    return view('blog.index'); // Thay 'blog.index' bằng view thực tế của bạn
});

Route::get('register', [RegisterController::class, 'register']);
