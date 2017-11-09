<?php

namespace App\Listener;

use App\Events\CreacionExtension;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreacinIaxBuddies
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
     * @param  CreacionExtension  $event
     * @return void
     */
    public function handle(CreacionExtension $event)
    {
        logger($event->extension->toArray());
    }
}
