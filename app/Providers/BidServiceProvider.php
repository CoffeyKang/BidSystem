<?php

namespace App\Providers;

use App\Interfaces\BidInterface;
use App\Services\Bid;
use Illuminate\Support\ServiceProvider;

class BidServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BidInterface::class, Bid::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
