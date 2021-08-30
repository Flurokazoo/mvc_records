<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['active']);
    }
    public function index(Review $review)
    {
        if (!$review->isOwnedByUser(auth()->user())) {
            abort(403, 'Access denied');
        }
        return view('review', [
            'review' => $review,
        ]);
    }

    public function update(Review $review, Request $req)
    {
        if (!$review->isOwnedByUser(auth()->user())) {
            abort(403, 'Access denied');
        }
        $review->update([
            'body' => $req->body
        ]);
        return redirect()->route('album', ['album' => $review->album->id]);
    }

    public function post(Album $album, Request $req)
    {
        if (!auth()->user()->canPost()) {
            abort(403, 'Access denied');
        }
        
        $this->validate($req, [
            'body' => 'required'
        ]);

        $req->user()->reviews()->create([
            'body' => $req->body,
            'album_id' => $album->getAttribute('id')
        ]);

        return back();
    }

    public function destroy(Review $review)
    {
        if (!$review->isOwnedByUser(auth()->user())) {
            abort(403, 'Access denied');
        }
        $review->delete();
        return back();
    }
}
