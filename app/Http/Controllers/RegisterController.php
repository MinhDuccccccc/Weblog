<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register'); // Ensure 'auth.register' exists in resources/views
    }
}
