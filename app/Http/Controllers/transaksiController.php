<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Kategori;
use App\ProductTransaksi;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Auth;
use Darryldecode\Cart\CartCondition;

use Haruncpi\LaravelIdGenerator\IdGenerator;
class transaksiController extends Controller
{
    //
     public function index()
    {

    	      $products = Barang::when(request('search'), function($query){
                        return $query->where('namaBarang','like','%'.request('search').'%');
                    })
                    ->orderBy('created_at','desc')
                    ->paginate(12);

               //cart item
        if(request()->tax){
            $tax = "+10%";
        }else{
            $tax = "0%";
        }

        $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'pajak',
                'type' => 'tax', //tipenya apa
                'target' => 'total', //target kondisi ini apply ke mana (total, subtotal)
                'value' => $tax, //contoh -12% or -10 or +10 etc
                'order' => 1
            ));      
        \Cart::session(Auth()->id())->condition($condition);          

        $items = \Cart::session(Auth()->id())->getContent();
        
        if(\Cart::isEmpty()){
            $cart_data = [];            
        }
        else{
            foreach($items as $row) {
                $cart[] = [
                    'rowId' => $row->id,
                    'name' => $row->name,
                    'qty' => $row->quantity,
                    'pricesingle' => $row->price,
                    'price' => $row->getPriceSum(),
                    'created_at' => $row->attributes['created_at'],
                ];           
            }
            
            $cart_data = collect($cart)->sortBy('created_at');

        }
        
        //total
        $sub_total = \Cart::session(Auth()->id())->getSubTotal();
        $total = \Cart::session(Auth()->id())->getTotal();

        $new_condition = \Cart::session(Auth()->id())->getCondition('pajak');
        $pajak = $new_condition->getCalculatedValue($sub_total); 

        $data_total = [
            'sub_total' => $sub_total,
            'total' => $total,
            'tax' => $pajak
        ];

        $kategoris = Kategori::all();
        $barangs = Barang::all();

        return view('transaksi.index',compact('products','kategoris','cart_data','data_total'));

    }


    public function addProductCart($id){
        $product = Barang::find($id);      
                
        $cart = \Cart::session(Auth()->id())->getContent();        
        $cek_itemId = $cart->whereIn('id', $id);  
      
        if($cek_itemId->isNotEmpty()){
            if($product->qty == $cek_itemId[$id]->quantity){
                return redirect()->back()->with('error','jumlah item kurang');
            }else{
                \Cart::session(Auth()->id())->update($id, array(
                    'quantity' => 1
                ));
            }            
        }else{
             \Cart::session(Auth()->id())->add(array(
            'id' => $id,
            'name' => $product->namaBarang,
            'price' => $product->hargaJualSatuan,
            'quantity' => 1, 
            'attributes' => array(
                'created_at' => date('Y-m-d H:i:s')
            )          
        ));
        
        }       

        return redirect()->back();
    }
   

    public function removeProductCart($id){
        \Cart::session(Auth()->id())->remove($id);     
                         
        return redirect()->back();
    }
 public function bayar(){

        $cart_total = \Cart::session(Auth()->id())->getTotal();
        $bayar = request()->totalHidden;
        $kembalian = (int)$bayar - (int)$cart_total;
               
        if($kembalian >= 0){  
            DB::beginTransaction();

            try{

            $all_cart = \Cart::session(Auth()->id())->getContent();
           

            $filterCart = $all_cart->map(function($item){
                return [
                    'id' => $item->id,
                    'quantity' => $item->quantity
                ];
            });

            foreach($filterCart as $cart){
                $product = Barang::find($cart['id']);
                
                if($product->stock == 0){
                    return redirect()->back()->with('errorTransaksi','jumlah pembayaran gak valid');  
                }

              
                
                $product->decrement('stock',$cart['quantity']);
            }
            
            $id = IdGenerator::generate(['table' => 'transaksi', 'length' => 10, 'prefix' =>'INV-', 'field' => 'invoices_number']);

            Transaksi::create([
                'invoices_number' => $id,
                'user_id' => Auth::id(),
                'pay' => request()->totalHidden,
                'total' => $cart_total
            ]);

            foreach($filterCart as $cart){    

                ProductTransaksi::create([
                    'product_id' => $cart['id'],
                    'invoices_number' => $id,
                    'qty' => $cart['quantity'],
                ]);                
            }

            \Cart::session(Auth()->id())->clear();          

            DB::commit();        
            return redirect()->back()->with('success','Transaksi Berhasil dilakukan Tahu Coding | Klik History untuk print');        
            }catch(\Exeception $e){
            DB::rollback();
                return redirect()->back()->with('errorTransaksi','jumlah pembayaran gak valid');        
            }        
        }
        return redirect()->back()->with('errorTransaksi','jumlah pembayaran gak valid');        

    }
       public function clear(){
        \Cart::session(Auth()->id())->clear();
        return redirect()->back();
    }

    public function decreasecart($id){
        $product = Barang::find($id);      
                
        $cart = \Cart::session(Auth()->id())->getContent();        
        $cek_itemId = $cart->whereIn('id', $id); 

        if($cek_itemId[$id]->quantity == 1){
            \Cart::session(Auth()->id())->remove($id);  
        }else{
            \Cart::session(Auth()->id())->update($id, array(
            'quantity' => array(
                'relative' => true,
                'value' => -1
            )));            
        }
        return redirect()->back();

    }

    public function increasecart($id){
        $product = Barang::find($id);     
            
        $bayar = request()->qy;
        $cart = \Cart::session(Auth()->id())->getContent();        
        $cek_itemId = $cart->whereIn('id', $id); 

        if($product->stock == $cek_itemId[$id]->quantity){
            return redirect()->back()->with('error','jumlah item kurang');
        }else{
            \Cart::session(Auth()->id())->update($id, array(
            'quantity' => array(
                'relative' => true,
                'value' => $bayar
            )));

            return redirect()->back();
        }        

    }

    public function increasecart1($id){
        $product = Barang::find($id);     
            
        $bayar1 = request()->price1;
        $cart = \Cart::session(Auth()->id())->getContent();        
        $cek_itemId = $cart->whereIn('id', $id); 

        // ddd($cart);
            \Cart::session(Auth()->id())->update($id, array(
             'price' => $bayar1));

            return redirect()->back();
             
    }
    
    	
    public function history(){
        $history = Transcation::orderBy('created_at','desc')->paginate(10);
        return view('pos.history',compact('history'));
    }

    public function laporan($id){
        $transaksi = Transcation::with('productTranscation')->find($id);
        return view('laporan.transaksi',compact('transaksi'));
    }

}
