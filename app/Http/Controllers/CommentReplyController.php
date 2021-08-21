<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentRepley;
use Auth;

class CommentReplyController extends Controller
{
    public function store(Request $request, $comment)
    {
        $this->validate($request, ['message' => 'required|max:1000']);
        $commentReply = new CommentRepley();
        $commentReply->comment_id = $comment;
        $commentReply->user_id = Auth::id();
        $commentReply->message = $request->message;
        $commentReply->save();
  
        $notification = array(
            'messege' => 'Comment Successfully Added',
            'alert-type' => 'success'
        );
        return redirect()->back();
    }
}
