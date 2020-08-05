<?php
namespace App\Interfaces;

interface BidInterface
{   
    public function bid(int $userId, int $itemId, int $amount);
}

?>