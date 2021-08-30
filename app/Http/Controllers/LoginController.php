<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        return view('login');
    }

    public function post(Request $req)
    {
        $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!auth()->attempt($req->only('email', 'password'))) {
            return back()->with('status', "Incorrect login credentials");
        };

        return redirect()->route('dashboard');
    }
}
