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

    public function updateDispatcherStatus($orderId,$dispatcherId):void
    {
        Notification::where([
            'order_id'=>$orderId,
            'dispatcher_id'=>$dispatcherId
        ])->update(['status'=>'declined']);

    }

    private function orderOwner($userId)
    {
        return User::find($userId)->id;
    }

    public function newNotification($dispatcher,$userId,$orderId):void
    {
        Notification::create([
            'dispatcher_id'=>$dispatcher->id??0,
            'user_id'=>$this->orderOwner($userId),
            'status'=>$dispatcher?'pending':'declined',
            'order_id'=>$orderId
        ]);
    }

    public function updateNotificationStatus($id,$value):void
    {
        $this->filter($id)
             ->update(['status'=>$value]);
    }

    public function delivered($notification)
    {
        $this->updateNotificationStatus($notification->id,'delivered');
        $this->dispatcher()->whereId($notification->dispatcher->id)
                           ->update(['is_available'=>true]);//update dispatcher availability
    }

}
