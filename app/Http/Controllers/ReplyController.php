<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request,Comment $comment)
    {
        $comment->replies()->create([
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);

        return back()->with('alert', __('messages.reply_saved'));
    }
}
