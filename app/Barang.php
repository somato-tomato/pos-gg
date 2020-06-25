<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kodeBarang',
        'namaBarang',
        'kategori',
        'satuan',
        'hargaJualSatuan',
        'stock',
        'minStock',
        'jmlPerdus'
    ];
}
