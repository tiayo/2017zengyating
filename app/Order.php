<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'commodity', 'score', 'price', 'order_time', 'manager_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function manager()
    {
        return $this->belongsTo('App\Manager', 'manager_id');
    }

    public function commodity()
    {
        return $this->hasOne('App\Commodity', 'id');
    }
}
