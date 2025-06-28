<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create() {
        return view('Comment-form');
    }

    public function agg_comment(Request $request) {
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->job_offer_id = $request->job_offer_id;
        $comment->content = $request->content;
        $comment->save();

        return $comment;
    }
}
