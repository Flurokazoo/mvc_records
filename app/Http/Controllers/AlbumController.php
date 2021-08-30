<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Http\Controllers\Controller;
use App\Models\Review;


class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['active']);
    }

    public function index(Album $album)
    {
        //dd($album->tags);
        $reviews = Review::latest()->where('album_id', $album->id)->with(['user', 'likes'])->paginate(5);
        return view('album', [
            'album' => $album,
            'reviews' => $reviews
        ]);
    }

    public function post(Request $req)
    {
        //dd($req->input('tag'));
        $this->validate($req, [
            'name' => 'required',
            'artist' => 'required',
            'year' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);

        $imageName = $req->artist . '-' . $req->year . '-' . $req->name . '.' . $req->image->extension();
        $req->image->move(public_path('img'), $imageName);

        $album = Album::create([
            'name' => $req->name,
            'artist' => $req->artist,
            'year' => $req->year,
            'image_path' => $imageName
        ]);

        foreach ($req->input('tag') as $tag) {
            $album->tags()->attach($tag);
        }

        return redirect()->route('dashboard');
    }
}
