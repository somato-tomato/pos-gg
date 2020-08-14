<?php
//© 2020 Copyright: Tahu Coding
namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    //demi keamanan kalian harusnya ubah ini ke fillable ya
       protected $fillable = [
        'invoices_number','user_id','pay','total'
    ];

    protected $primaryKey = 'invoices_number';
    public $incrementing = false;
    protected $keyType = 'string';

     public function productTranscation(){
        return $this->hasMany(ProductTransaksi::class,'invoices_number','invoices_number');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
