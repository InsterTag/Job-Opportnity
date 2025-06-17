<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create() {
        return view('Comment-form');
    }

    public function agg_comment(Request $request) {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'job_offer_id' => 'required|integer|exists:job_offers,id',
            'content' => 'required|string|min:10|max:1000'
        ]);

        $comment = new Comment();
        $comment->user_id = $validatedData['user_id'];
        $comment->job_offer_id = $validatedData['job_offer_id'];
        $comment->content = $validatedData['content'];
        $comment->save();

        return $comment;
    }
}