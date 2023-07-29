<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use App\Models\Dispatcher;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DispatcherNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderShipped $event)
    {

    $dispatcher = app(Dispatcher::class);
    $notification = app(Notification::class);
    $selectedDispatcher = $dispatcher->AvailableDispatcher($event->order->id)
                                     ->first();//dispatcher selection
    $notification->newNotification(
        $selectedDispatcher,
        auth()->user()->id,
        $event->order->id
    );//create new notification
   
    $selectedDispatcher!==null?
    $dispatcher->updateDispatchAvailability(
        $selectedDispatcher->id,
        false
    ):null;//updateDispatchAvailability
        
    }
}
