<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function post(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
        ]);

        Tag::create([
            'name' => $req->name,
        ]);

        return back();
    }
}
