<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{   
    use RefreshDatabase;
    /**
     * @var Category $newCategory
     */
    public $newCategory;

    public function setUp(): void
    {
        parent::setUp();
        $this->newCategory = factory(\App\Category::class)->create();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {   
        $this->assertDatabaseHas('categories', [
            'name' => $this->newCategory->name,
            'id' => $this->newCategory->id,
        ]);
    }
}
