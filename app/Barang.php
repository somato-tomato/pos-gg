<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kodeBarang',
        'namaBarang',
        'satuan',
        'hargaJualSatuan',
        'stock',
        'minStock',
        'jmlPerdus'
    ];
}
