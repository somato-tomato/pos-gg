<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'idSupplier', 'kodeBarang', 'namaBarang', 'kategori', 'satuan', 'hargaBeli', 'hargaJualSatuan','stock','minStock','jmlPerdus'
    ];
}
