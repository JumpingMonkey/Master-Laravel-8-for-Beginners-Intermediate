<?php

namespace App\Listeners;

use Illuminate\Cache\Events\CacheHit;
use Illuminate\Cache\Events\CacheMissed;
use Illuminate\Support\Facades\Log;

class CacheSubscriber

{
    /**
     * Handle the event.
     *
     * @param CacheHit $event
     * @return void
     */
    public function handleCacheHit(CacheHit $event)
    {
        Log::info("{$event->key} cache hit");
    }

    /**
     * Handle the event.
     *
     * @param CacheMissed $event
     * @return void
     */
    public function handleCacheMissed(CacheMissed $event)
    {
        Log::info("{$event->key} cache miss");
    }

    /**
     * Handle the event.
     *
     * @param $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            CacheHit::class,
            [CacheSubscriber::class, 'handleCacheHit']
        );

        $events->listen(
            CacheMissed::class,
            [CacheSubscriber::class, 'handleCacheMissed']
        );
    }
}
