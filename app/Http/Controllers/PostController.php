<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'comments', 'likes')->orderBy('created_at', 'desc')->get();    
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return redirect()->back();
    }
}
