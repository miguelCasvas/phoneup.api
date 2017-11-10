<?php

namespace App\Listener;

use App\Events\CreacionExtension;
use App\Models\IaxBuddies;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreacionIaxBuddies
{

    /**
     * @var IaxBuddies
     */
    private $modelIaxBuddies;

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        $this->modelIaxBuddies = new IaxBuddies();

    }

    /**
     * Handle the event.
     *
     * @param  CreacionExtension  $event
     * @return void
     */
    public function handle(CreacionExtension $event)
    {
        $this->modelIaxBuddies->insercionExtension([
            'name' => $event->extension->extension,
            'username' => $event->extension->extension,
        ]);
    }
}
