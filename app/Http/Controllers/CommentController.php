<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back();
    }
}
