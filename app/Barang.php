<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kodeSupplier', 'kodeBarang', 'namaBarang', 'kategori', 'satuan', 'hargaBeli', 'hargaJualSatuan'
    ];
}
