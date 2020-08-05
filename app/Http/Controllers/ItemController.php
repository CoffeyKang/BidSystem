<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    public function __invoke($id)
    {
        $item = Item::findOrfail($id);
        $minBid = $item->lowestBidAmount();
        $maxBid = $item->highestBidAmount();
        $firstHighestUserId = $item->firstHighestBid();

        return response()->json([
            'id' => $id,
            'name' => $item->name,
            'min_bid' => $minBid,
            'highest_bid' => $maxBid,
            'highest_bid_user_id' => $firstHighestUserId,
        ], 200);

    }
}
