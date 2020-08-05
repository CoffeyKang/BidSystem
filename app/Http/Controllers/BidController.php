<?php

namespace App\Http\Controllers;

use App\Interfaces\BidInterface;
use App\Http\Requests\BidRequest;
use App\Item;
use App\User;
use App\BidForItem;
use App\Exceptions\BidException;

class BidController extends Controller
{   
    public $bidService;
    public function __construct(BidInterface $bidInterface)
    {
        $this->bidService = $bidInterface;
    }
    public function __invoke(BidRequest $request)
    {

        /** first step to validate the form input */
        $valided = $request->validated();

        try{
            $this->bidService->bid($request->userId, $request->itemId, $request->amount);
        }catch (BidException $e){
            
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json(
            [
                'message' => 'Congratulations.'
            ], 200
        );
       

        

     
     
    
    }
}
