<?php
namespace App\Services;

use App\Interfaces\BidInterface;
use App\Exceptions\BidException;
use App\Item;
use App\BidForItem;

class Bid implements BidInterface
{
    public function bid(int $userId, int $itemId, int $amount)
    {   

        $item = Item::find($itemId);
        if($amount < $item->min_price){
            throw new BidException('The bid amount is smaller than the item min price.');
        }
        $highestPrice = BidForItem::where('item_id', $itemId)->get()->max('bid_amount');
        if($highestPrice === null || $highestPrice <= $amount) {
            $newBid = new BidForItem;
            $newBid->item_id = $itemId;
            $newBid->user_id = $userId;
            $newBid->bid_amount = $amount;
            $newBid->save();
        } else {
            throw new BidException('Someone bid the higher price than you.');
        }
    }
}

?>