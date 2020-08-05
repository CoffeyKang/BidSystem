<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BidForItem extends Model
{
    public function item(): BelongsTo
    {
        return $this->belongsTo('Item', 'id', 'item_id');
    }
}
