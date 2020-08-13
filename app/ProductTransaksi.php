<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTransaksi extends Model
{
	
    protected $table = 'producttransaksi';
    //demi keamanan kalian harusnya ubah ini ke fillable ya
   protected $fillable = [
        'product_id', 'invoices_number', 'qty'
    ];

    public function product(){
        return $this->belongsTo(Barang::class);
    }
   
}
