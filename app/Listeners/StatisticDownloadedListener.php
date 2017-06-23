<?php

namespace App\Listeners;

use App\Events\StatisticDownloadedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //dd(\Auth::user()->id, 'listener: '.$event->statistic);
    }
}
