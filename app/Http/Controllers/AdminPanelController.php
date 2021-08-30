<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $users = User::get()->where('admin', 0);
        $tags = Tag::get();
        return view('admin', [
            'tags' => $tags,
            'users' => $users
        ]);    
    }

    public function post(User $user)
    {  
        User::where('id', $user->getAttribute('id'))->update(['active' => 1]);    
        return back();
    }

    public function destroy(User $user)
    {  
        User::where('id', $user->getAttribute('id'))->update(['active' => 0]);    
        return back();
    }
}
