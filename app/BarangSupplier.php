<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangSupplier extends Model
{
    protected $fillable = [
        'idSupplier', 'idBarang', 'hargaBeli'
    ];
}
