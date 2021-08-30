<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Tag;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['active']);
    }
    public function index()
    {
        $albums = Album::orderBy('artist')->get();
        $tags = Tag::get();
        //dd($tags);
        return view('dashboard', [
            'tags' => $tags,
            'albums' => $albums
        ]);
    }

    public function post(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
            'artist' => 'required',
            'year' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);

        $imageName = $req->artist . '-' . $req->year . '-' . $req->name . '.' . $req->image->extension();
        $req->image->move(public_path('img'), $imageName);

        Album::create([
            'name' => $req->name,
            'artist' => $req->artist,
            'year' => $req->year,
            'image_path' => $imageName
        ]);

        return redirect()->route('dashboard');
    }
}
