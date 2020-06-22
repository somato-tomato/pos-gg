<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangStock extends Model
{
    protected $fillable = [
        'idBarang', 'namaBarang', 'stockMasuk', 'keterangan'
    ];
}
