<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
      'idOrder', 'idBarang', 'qty', 'hargaJualSatuan'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
