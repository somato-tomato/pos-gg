<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangKategori extends Model
{
    protected $fillable = [
        'idBarang', 'idKategori'
    ];
}
