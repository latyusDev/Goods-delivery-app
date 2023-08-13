<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class Dispatcher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name','email',
        'password','phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function fullName() : Attribute
    {
        return new Attribute(
            get: fn()=> $this->first_name. ' ' .$this->last_name
        );
    }

    public function scopeFilter($query,$id)
    {
        return $query->whereId($id);
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addresable');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function order($orderId)
    {
        return Order::find($orderId)
                    ->user->address
                    ->local_government;
    }
    
    private function dispatchersId($orderId)
    {
        $dispatchers_id = Notification::where([
            'order_id' => $orderId,
            'status' => 'declined'
        ])->pluck('dispatcher_id');
        return $dispatchers_id;
    }


    public function AvailableDispatcher($orderId)
    {
        $AvailableDispatcher = Dispatcher::whereHas('address',function($query)use($orderId)
        {
            return $query->where([
                  'is_available'=>true,
                  'local_government'=>$this->order($orderId)
                  ]);
        });
        return $AvailableDispatcher;
    }

    public function newDispatcher($orderId)
    {
        $new_dispatcher = $this->AvailableDispatcher($orderId)
                               ->whereNotIn('id',$this->dispatchersId($orderId))
                               ->whereisAvailable(true)
                               ->first();
        return $new_dispatcher;
    }

    public function updateDispatchAvailability($dispatcherId,$value)
    {
        $this->filter($dispatcherId)
             ->update(['is_available'=>$value]);
        return null;
    }

    public function delivered($id)
    {
        Notification::filter($id)
                    ->update(['status'=>'delivered']);
        $this->updateDispatchAvailability(
             Auth::guard('dispatcher')->id(),
             true
        );
        return null;
    }
  
}

