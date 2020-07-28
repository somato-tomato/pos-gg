<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Order;
use App\OrderCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;

class OrderDbController extends Controller
{
    public function first()
    {
        return view('orderDB.orderFirst');
    }

    public function createInvoice()
    {
        $invoice = Order::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(5)) , 5,"0") as invoice')->first();
        $code_invoice = date('Ym').'-INV-'.$invoice->invoice;

        Order::create([
            'invoice' => $code_invoice,
            'idUser' => auth()->user()->id
        ]);

        return redirect()->route('noJS.second', $code_invoice)->with('message', 'Silahkan Belanja!');
    }

    public function second($invoice)
    {
        $inv = DB::table('orders')
            ->where('invoice', '=', $invoice)
            ->first();
        $barang = Barang::orderBy('created_at', 'DESC')->get();
        $cart = DB::table('order_carts')
            ->join('orders', 'order_carts.idOrder', '=', 'orders.id')
            ->join('barangs', 'order_carts.idBarang', '=', 'barangs.id')
            ->select('barangs.namaBarang', 'order_carts.qty', 'order_carts.hargaBarang')
            ->where('orders.id', '=', $inv->id)
            ->get();
        $total = DB::table('order_carts')
            ->where('idOrder', '=', $inv->id)
            ->sum('hargaBarang');

        return view('orderDB.orderSecond', compact('inv', 'barang', 'cart', 'total'));
    }

    public function getBarang($id)
    {
        $barangs = Barang::findOrFail($id);
        return response()->json($barangs, 200);
    }

    public function storeCart(Request $request)
    {
        $harga = DB::table('barangs')
            ->select('hargaJualSatuan')
            ->where('id', '=' , $request->barang_id)
            ->first();

        $this->validate($request, [
            'barang_id' => 'required',
            'qty' => 'required'
        ]);

        $form_data = array(
            'idOrder' => $request->idOrder,
            'idBarang' =>  $request->barang_id,
            'qty' => $request->qty,
            'hargaBarang' => $request->qty * $harga->hargaJualSatuan
        );

        $exist = DB::table('order_carts')->where('idOrder', $request->idOrder)->exists();
        $existBarang = DB::table('order_carts')->where([['idOrder', $request->idOrder], ['idBarang', $request->barang_id]])->exists();
        $stock = DB::table('barangs')->select('stock')->where('id', $request->barang_id)->first();

//        ddd($request->qty > $stock->stock);

        if ( $exist )
        {
            if ( $existBarang && $request->qty <= $stock->stock )
            {
                OrderCart::where([['idOrder', '=', $request->idOrder], ['idBarang', '=', $request->barang_id]])
                    ->increment('qty', $request->qty);
                $hargaAwal = DB::table('order_carts')
                    ->select('qty')
                    ->where([['idOrder', $request->idOrder], ['idBarang', $request->barang_id]])
                    ->first();
                $hargaBaru = $hargaAwal->qty * $harga->hargaJualSatuan;
                OrderCart::where([['idOrder', '=', $request->idOrder], ['idBarang', '=', $request->barang_id]])
                    ->update(['hargaBarang' => $hargaBaru]);
                Barang::where('id', $request->barang_id)->decrement('stock', $request->qty);

                return back()->with('message', 'Quantity di MASUK');
            } else if ( $existBarang && $request->qty > $stock->stock )
            {
                return back()->with('message', 'STOCK TIDAK MENCUKUPI');
            }
        } else if ( $request->qty <= $stock->stock )
        {
            OrderCart::create($form_data);

            DB::table('barangs')
                ->where('id', $request->barang_id)
                ->decrement('stock', $request->qty);

            return back()->with('message', '$request->qty < $stock');
        } else if ( $request->qty > $stock->stock )
        {
            return back()->with('message', 'STOCK TIDAK MENCUKUPI');
        }
    }

    public function bayarOrder(Request $request, $id)
    {
        $total = DB::table('order_carts')
            ->where('idOrder', '=', $id)
            ->sum('hargaBarang');

        DB::table('orders')
            ->where('id', $id)
            ->update(['total' => $total]);

        $totalHarga = DB::table('orders')
            ->select('total', 'invoice')
            ->where('id', '=', $id)
            ->first();

        $this->validate($request, [
            'bayar' => 'required'
        ]);

        if ($request->bayar < $totalHarga->total)
        {
            return back()->with('messageError', 'KURANG DUIT NA COK');
        } else {
            DB::table('orders')
                ->where('id', $id)
                ->update(['bayar' => $request->bayar]);

            $kembali = $request->bayar - $totalHarga->total;

            return redirect()->route('noJS.kwitansi', $totalHarga->invoice)->with('message', 'TERIMA KASIH TELAH BERBELANJA DI TOKO KAMI');
        }
    }

    public function kwitansi($invoice)
    {
        $toko = DB::table('tokos')
            ->first();

        $list = DB::table('order_carts')
            ->join('orders', 'order_carts.idOrder', '=', 'orders.id')
            ->join('barangs', 'order_carts.idBarang', '=', 'barangs.id')
            ->select('barangs.namaBarang', 'barangs.hargaJualSatuan', 'order_carts.qty', 'order_carts.hargaBarang')
            ->where('orders.invoice', '=', $invoice)
            ->get();

        $order = DB::table('orders')
            ->select('total', 'bayar', 'invoice', 'updated_at')
            ->where('invoice', '=', $invoice)
            ->first();

        $kembali = $order->bayar - $order->total;


        $mid = '123123456';
        $store_name = $toko->namaToko;
        $store_address = $toko->alamatToko;
        $store_phone = $toko->nomorToko;
        $store_email = $toko->emailToko;
        $store_website = $toko->websiteToko;
        $tax_percentage = 10;
        $transaction_id = $order->invoice;

        $printer = new ReceiptPrinter;
        $printer->init(
            config('receiptprinter.connector_type'),
            config('receiptprinter.connector_descriptor')
        );

        $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);

        foreach ($list as $l) {
            $printer->addItem(
                $l['namaBarang'],
                $l['hargaJualSatuan'],
                $l['qty']
            );
        }
        $printer->setTax($tax_percentage);

        $printer->calculateSubTotal();
        $printer->calculateGrandTotal();

        $printer->setTransactionID($transaction_id);

        $printer->setQRcode([
            'tid' => $transaction_id,
        ]);

        $printer->printReceipt();

        return view('orderDB.orderThird', compact('list', 'order', 'kembali'));

        //TODO receiptprinter.php CHECK TO CONFIGURE THE PRINTER
    }

//    public function printStruk($invoice)
//    {
//
//    }
}
