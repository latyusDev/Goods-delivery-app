<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [

          'local_government',
          'addresable_type',
          'addresable_id',
          'street',
          'state',
          'number'
        ];

    

    public function addresable()
    {
        return $this->morphTo();
    }
}
