<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'kodeSupplier', 'namaSupplier', 'alamat', 'namaKontak', 'noHP'
    ];
}
