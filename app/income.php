<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class income extends Model
{
   protected $fillable=[
        'user_id','title','price','purchased_at'
        ];
}
