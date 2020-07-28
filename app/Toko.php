<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $fillable = [
        'namaToko', 'alamatToko', 'nomorToko', 'emailToko', 'websiteToko'
    ];
}
