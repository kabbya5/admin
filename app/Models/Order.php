<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
class Order extends Model implements Searchable
{
    protected $guarded = [];
    public $timestamps = true;

    use Sluggable;
    public function Sluggable(){
      return [
        'slug' =>[
          'source' => 'name'
        ]
      ];
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('view.order', $this->id);

        return new SearchResult(
            $this,
            $this->order_code,
            $url
         );
    }
}
