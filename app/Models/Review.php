<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\Album;
use App\Models\User;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'album_id'
    ];

    public function isOwnedByUser(User $user)
    {
        return $user->id === $this->user_id;
    }

    public function hasLiked(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
