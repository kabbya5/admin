<?php

namespace App\Models;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model implements Searchable
{
    protected $guarded = [];

    public function getSearchResult(): SearchResult
    {
        $url = route('view.order', $this->order_id);

        return new SearchResult(
            $this,
            $this->order_id,
            $url
         );
    }
}
