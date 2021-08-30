<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['active']);
    }
    
    public function post(Review $review, Request $req)
    {
        //dd($review->hasLiked($req->user()));
        $review->likes()->create([
            'user_id' => $req->user()->id,
        ]);

        return back();
    }

    public function destroy(Review $review, Request $req)
    {
        $req->user()->likes()->where('review_id', $review->id)->delete();
        return back();
    }
}
