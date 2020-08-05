<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{   
    /**
     * @var String 
     * */
    protected $talbe = 'items';

    /**
     * @var Array
     */
    protected $guarded = [];

    
    // if return 0 means nobody bid for this one
    public function firstHighestBid(): int
    {
        $maxBid = $this->bids()->max('bid_amount');
        $firstHighest = $this->bids()->where('bid_amount', $maxBid)->orderBy('created_at')->first();
        if($firstHighest ===null) {
            return 0;
        }
        return $firstHighest->id;
    }

    public function lowestBidAmount(): int
    {
        return $this->bids()->min('bid_amount')?:$this->min_price;
    }

    public function highestBidAmount(): int
    {
        return $this->bids()->max('bid_amount')?:$this->min_price;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Category');
    }


    public function bids(): HasMany
    {
        return $this->hasMany('App\BidForItem', 'item_id', 'id');
    }

    
}
