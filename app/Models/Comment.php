<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Product;
use App\Models\CommentRepley;

class Comment extends Model
{
   protected $guarded = [];

   public function user()
   {
       return $this->belongsTo(User::class);
   }

   public function product()
  {
      return $this->belongsTo(Post::class);
  }

   public function replies(){
       return $this->hasMany(CommentRepley::class);
   }
}
