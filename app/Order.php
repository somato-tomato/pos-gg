<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'idUser', 'invoice', 'total', 'bayar'
    ];

    public function order_detail()
    {
        return $this->hasMany('App\OrderDetail', 'idOrder');
    }
}
