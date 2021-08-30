<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function post()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
