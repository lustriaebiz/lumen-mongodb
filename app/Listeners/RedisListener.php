<?php

namespace App\Listeners;

use App\Events\Redis;

class RedisListener
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
     * @param  Redis  $event
     * @return void
     */
    public function handle(Redis $event)
    {
        //
    }

    public function onSubscribe($event) {
        die('haaah');
    }
    
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Redis',
            'App\Listeners\RedisListener@onSubscribe'
        );
    }
}
