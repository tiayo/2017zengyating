<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'commodity', 'score', 'price', 'order_time', 'manager_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function manager()
    {
        return $this->hasOne('App\Manager', 'id');
    }

    public function commodity()
    {
        return $this->hasOne('App\Commodity', 'id');
    }
}
