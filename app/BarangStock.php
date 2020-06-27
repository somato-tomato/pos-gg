<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangStock extends Model
{
    protected $fillable = [
        'idBarang', 'idSupplier', 'namaBarang', 'stockMasuk', 'keterangan'
    ];
}
