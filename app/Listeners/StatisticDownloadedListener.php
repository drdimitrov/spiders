<?php

namespace App\Listeners;

use App\Events\StatisticDownloadedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\DownloadStatistic;

class StatisticDownloadedListener
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
     * @param  StatisticDownloadedEvent  $event
     * @return void
     */
    public function handle(StatisticDownloadedEvent $event)
    {
        DownloadStatistic::create([
            'type' => $event->type,
            'place' => $event->place,
            'user_id' => \Auth::user()->id,
        ]);

    }
}
