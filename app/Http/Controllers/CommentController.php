<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use Auth;
class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
      $this->validate($request, ['message' => 'required|max:1000']); //change comment field to message
        $comment = new Comment();
        $comment->product_id = $id;
        $comment->user_id = Auth::id();
        $comment->message = $request->message; //change comment field to message
        $comment->save();

        $notification = array(
            'messege' => 'Comment Successfully Added',
            'alert-type' => 'success'
        );
        return redirect()->back();

    }
}
