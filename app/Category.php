<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{   
    /**
     * @var String $table
     */
    protected $table = 'categories';


   /**
     * Scope a query to sort categories name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeWithSortedItems($query)
    {
        return $query->orderBy('name');
    }


    /**
     * HasMany reslation ship
     */
    public function items(): HasMany
    {
        return $this->hasMany('App\Item');
    }
}
