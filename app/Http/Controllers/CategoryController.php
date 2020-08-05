<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    public function __invoke()
    {
        return Category::withSortedItems()->get();
    }
}
