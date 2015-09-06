<?php namespace App\Events;

use Illuminate\Queue\SerializesModels;

class ProductAddedToShoppingCart extends Event
{

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     */
    public function __construct()
    {
//
    }

}
