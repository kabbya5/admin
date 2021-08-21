<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use App\Models\User;
use App\Models\Comment;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Product extends Model implements Searchable
{
  protected $guarded=[];

  public function getSearchResult(): SearchResult
  {
      $url = route('product.view', $this->id);

      return new SearchResult(
          $this,
          $this->product_name,
          $url
      );
  }


  public function user()
  {
      return $this->belongsTo(User::class);
  }
  public function comments()
 {
     return $this->hasMany(Comment::class);
 }

  // Create Slug
  use Sluggable;
  public function Sluggable(){
    return [
      'slug' =>[
        'source' => 'name'
      ]
    ];
  }
}
