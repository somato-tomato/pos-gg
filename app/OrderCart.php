<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCart extends Model
{
    protected $fillable = [
        'idOrder', 'idBarang', 'qty', 'hargaBarang'
    ];
}
