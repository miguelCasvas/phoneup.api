<?php

namespace App\Listener;

use App\Events\EliminacionExtension;
use App\Models\Extensions_Asterisk;
use App\Models\IaxBuddies;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EliminarIaxBuddies
{
    /**
     * @var IaxBuddies
     */
    private $modelIaxBuddies;

    private $modelExtension_Asterisk;

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        $this->modelIaxBuddies = new IaxBuddies();
        $this->modelExtension_Asterisk = new Extensions_Asterisk();
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

        $extension = $event->extension->getAttribute('extension');
        $this->modelIaxBuddies = $this->modelIaxBuddies->where('username',$extension);
        $this->modelIaxBuddies->delete();

        $this->modelExtension_Asterisk = $this->modelExtension_Asterisk->where('exten', $extension);
        $this->modelExtension_Asterisk->delete();


    }
}
