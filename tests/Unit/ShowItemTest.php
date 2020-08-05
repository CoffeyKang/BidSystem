<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Exceptions\BidException;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowItemTest extends TestCase
{   
    use RefreshDatabase;
    /**
     * @var Item $item
     */
    public $item;

    /**
     * @var User
      */
    public $users;

    /**
     * @var Bid
     */
    public $bidService;


    public function setUp(): void
    {
        parent::setUp();

        $this->users = factory(User::class, 9)->create();
        factory(\App\Category::class, 10)->create();
        $this->item = factory(\App\Item::class)->create([
            'category_id' => \App\Category::all()->random()->id
        ]);
        $this->amount = rand(100, 1000);
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
        foreach ($this->users as $user) {
            try{
                $this->bidService->bid($user->id, $this->item->id, $this->amount);
            } catch (BidException $e) {
                echo $e->getMessage();
            }
            $this->amount +=50;
        }
        $respones = $this->get('/api/item/'.$this->item->id);
        $respones ->assertJson([
            "id" => $this->item->id,
            "name" => $this->item->name,
            "min_bid" => $this->item->lowestBidAmount(),
            "highest_bid" => $this->item->highestBidAmount(),
            "highest_bid_user_id" => $this->item->firstHighestBid(),
        ]);
    }
}
