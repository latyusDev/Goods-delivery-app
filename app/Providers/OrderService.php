<?php

namespace App\Services;

use App\Models\Dispatcher;
use App\Models\Notification;
use App\Models\Order;

class OrderService{

    public function store(array $orderData)
    {
        $item = $orderData;
        $item['price'] = $item['weight'];
        $item['user_id'] = auth()->user()->id;
        $order =  Order::create($item);
        $dispatcher = Dispatcher::whereIsAvailable(true)
                                ->first();
        Notification::create([
            'user_id'=>auth()->user()->id,
            'dispatcher_id'=>$dispatcher==null?0:$dispatcher->id,
            'order_id'=>$order->id,
            'status'=>'pending'
        ]);
       $dispatcher!==null?Dispatcher::whereId($dispatcher->id)
                    ->update(['is_available'=>false]):null;
        return $item;
    }
}