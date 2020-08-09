<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangRule extends Model
{
    protected $fillable = [
        'idBarang', 'jumlahBeli', 'harga'
    ];
}
