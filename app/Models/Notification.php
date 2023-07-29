<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','order_id',
        'dispatcher_id','status'
    ];
    
    public static $accepted = 'accepted';
    public static $delivered = 'delivered';

    public function scopeFilter($query,$id)
    {
        return $query->whereId($id);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function dispatcher()
    {
        return $this->belongsTo(Dispatcher::class);
    }

    public function updateDispatcherStatus($orderId,$dispatcherId)
    {
        Notification::where([
            'order_id'=>$orderId,
            'dispatcher_id'=>$dispatcherId
        ])->update(['status'=>'declined']);

        return null;
    }

    public function newNotification($dispatcher,$userId,$orderId)
    {
        Notification::create([
            'dispatcher_id'=>$dispatcher->id??0,
            'user_id'=>User::find($userId)->id,
            'status'=>$dispatcher?'pending':'declined',
            'order_id'=>$orderId
        ]);
        return null;
    }

    public function updateNotificationStatus($id,$value)
    {
        $this->filter($id)
             ->update(['status'=>$value]);
        return null;
    }

}
