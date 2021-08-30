<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        {     
            $albums = Album::inRandomOrder()->paginate(12);
            //dd($tags);
            return view('home', [
                'albums' => $albums
            ]);
        }
    }
}
