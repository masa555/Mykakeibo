<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kakeibo extends Model
{
    protected $fillable=[
        'user_id','title','price','purchased_at'
        ];
}
