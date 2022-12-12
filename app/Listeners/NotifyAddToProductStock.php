<?php

namespace App\Listeners;


use App\Events\AddToProductStock;

class NotifyAddToProductStock
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AddToProductStock  $event
     * @return void
     */
    public function handle(AddToProductStock $event)
    {

    }
}
