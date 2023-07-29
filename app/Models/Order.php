<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','price',
        'local_government','state',
        'weight','destination','user_id'
];



public function price() : Attribute
{
    return new Attribute(
        get:fn($price)=>$price.'NGN',
        set:fn($price)=>$this->state!=='Lagos'?$price*1000+5000:$price*1000
    );
}

public function weight() : Attribute
{
    return new Attribute(
        get:fn($weight)=> $weight.'kg',
    );
}

public function scopeFilter($query, $id)
{
    return $query->whereUserId($id);
}

public function user()
{
    return $this->belongsTo(User::class);
}

public function notifications()
{
    return $this->hasMany(Notification::class);
}

}
