<?php

namespace Tests\Unit;

use Illuminate\Support\Str;
use Tests\TestCase;

class AddItemTest extends TestCase
{   
    /** 
     * @var Array
     */
    public $item;

    /** 
     * @var Category
     */
    public $newCategory;


    /**
     * some basic config for adding new item
     */
    public function setUp(): void
    {   
        parent::setUp();
        $this->newCategory = factory(\App\Category::class)->create();
        $this->item = [
            'name' => Str::random(4),
            'category_id' => $this->newCategory->id,
            'min_price' => rand(1, 100),
        ];
    }

    /** @test */
    public function test_can_add_a_new_item()
    {   
        $response = $this->post('/api/addItem', $this->item);
        $response->assertStatus(200);
        $this->assertDatabaseHas('items', [
            'name' => $this->item['name'],
            'category_id' => $this->item['category_id'],
            'min_price' => $this->item['min_price'],
        ]);
    }
}
