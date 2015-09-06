<?php namespace App\Events;

use Illuminate\Queue\SerializesModels;

class NewCustomerOrderCreated extends Event
{

    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        //
    }

}
