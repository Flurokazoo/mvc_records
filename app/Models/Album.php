<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    protected $fillable = [
        'name',
        'artist',
        'year',
        'image_path'
    ];

    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
