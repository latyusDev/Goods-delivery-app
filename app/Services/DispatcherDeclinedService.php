<?php
namespace App\services;

use App\Models\Dispatcher;
use App\Models\Notification;

class DispatcherDeclinedService {

    public function __construct(
         private Dispatcher $dispatcher,
         private notification $notification
        ){}
        
    public function declined($orderId,$userId,$dispatcherId)
    {
        $this->notification->updateDispatcherStatus($orderId,$dispatcherId);
        $new_dispatcher = $this->dispatcher->newDispatcher($orderId);
        if($new_dispatcher){
            $this->notification->newNotification($new_dispatcher,$userId,$orderId);
            
            $this->dispatcher->updateDispatcherAvailability(
                $new_dispatcher->id,
                false,
                'is_available'
            );
        }else{
            $this->notification->newNotification(0,$userId,$orderId);
        }
        $this->dispatcher->updateDispatcherAvailability(
            $dispatcherId,
            true,
            'is_available'
        );
        return $new_dispatcher;
    } 
}