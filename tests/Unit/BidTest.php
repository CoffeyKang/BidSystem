<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Item;
use App\Category;
use App\User;
use App\Exceptions\BidException;

class BidTest extends TestCase
{   

    /**
     * @var User
     */
    public $singleUser;
    /**
     * @var Item
     */
    public $singleItem;
    /** 
     * @var Item
     */
    public $items;
    /**
     * @var Category;
     */
    public $categories;
    /**
     * @var Users;
     */
    public $users;
    /** 
     * @var int
     */
    public $amount;
     /**
     * @var BidforItem;
     */
    public $bidForItem;

    /**
     * @var Bid
     */
    public $bidService;
    public function setUp(): void
    {
        parent::setUp();
        $this->categories = factory(Category::class, 10)->create();
        $this->items = factory(Item::class, 10)->create([
            'category_id'=> $this->categories->random()->id
        ]);
        $this->users = factory(User::class, 10)->create();
        $this->amount = rand(100, 1000);
        
        $this->singleItem = Item::all()->random();
        $this->singleUser = User::all()->random();
        /**
         * get bid service class
         */
        $this->bidService = app()->make(\App\Interfaces\BidInterface::class);

    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {      
        try{
            $this->bidService->bid($this->singleUser->id, $this->singleItem->id, $this->amount);
        } catch (BidException $e) {
            echo $e->getMessage();
        }
        $this->assertDatabaseHas('bid_for_items',[
            'item_id' => $this->singleItem->id,
            'user_id' => $this->singleUser->id,
            'bid_amount' => $this->amount,
        ]);
    }
}
