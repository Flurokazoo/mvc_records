<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        return view('registration');
    }

    public function post(Request $req)
    {
        $this->validate($req, [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        User::create([
            'username' => $req->username,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'active' => true,
            'admin' => false
        ]);

        auth()->attempt($req->only('email', 'password'));

        return redirect()->route('dashboard');
    }
}
