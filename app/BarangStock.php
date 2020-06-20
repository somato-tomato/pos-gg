<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangStock extends Model
{
    protected $fillable = [
        'kodeBarang', 'namaBarang', 'stokMasuk', 'keterangan','KodeSupplier'
    ];
}
