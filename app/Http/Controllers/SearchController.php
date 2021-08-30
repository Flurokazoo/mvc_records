<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Album;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['active']);
    }
    
    public function post(Request $req)
    {
        $tags = Tag::get();
        if ($req->tag) {
            $ids = [];
            $fullTags = Tag::with('albums')->where('id', $req->tag)->get();
            $albums = $fullTags[0]->albums;
            foreach ($albums as $album) {
                array_push($ids, $album->id);
            };
        }

        if ($req->body && !empty($ids)) {
            $albums = Album::where('name', 'LIKE', '%' . $req->body . '%')
                ->orWhere('artist', 'LIKE', '%' . $req->body . '%')
                ->orWhere('year', 'LIKE', '%' . $req->body . '%')
                ->where('id', $ids[0])
                ->get();
        } else if($req->body) {
            $albums = Album::where('name', 'LIKE', '%' . $req->body . '%')
                ->orWhere('artist', 'LIKE', '%' . $req->body . '%')
                ->orWhere('year', 'LIKE', '%' . $req->body . '%')
                ->get();
        } 

        if(!$req->tag && !$req->body){
            $albums = Album::get();
        }

        return view('dashboard', [
            'tags' => $tags,
            'albums' => $albums
        ]);
    }
}
