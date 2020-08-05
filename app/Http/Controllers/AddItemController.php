<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewItem;
use App\Item;

class AddItemController extends Controller
{
    public function __invoke(StoreNewItem $request)
    {   
        $validated = $request->validated();
        
        $item = Item::create($validated);
        if($item !== null) {
            return response()->json([
                'item' => $item,
            ], 200);
        };

        return response()->json([
            'message' => 'invaild input'
        ]);
    }
}
