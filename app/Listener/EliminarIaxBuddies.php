<?php

namespace App\Listener;

use App\Events\EliminacionExtension;
use App\Models\IaxBuddies;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EliminarIaxBuddies
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
     * Eliminación de la extension en la entidad iax_buddies
     *
     * @param  EliminacionExtension  $event
     * @return void
     */
    public function handle(EliminacionExtension $event)
    {

        $idExtension = $event->extension->getAttribute('extension');
        $this->modelIaxBuddies = $this->modelIaxBuddies->where('username',$idExtension);
        $this->modelIaxBuddies->delete();

    }
}
