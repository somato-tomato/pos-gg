<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orderAdd()
    {
        $barang = Barang::orderBy('created_at', 'DESC')->get();
        return view('order.orderAdd', compact('barang'));
    }

    public function getBarang($id)
    {
        $barangs = Barang::findOrFail($id);
        return response()->json($barangs, 200);
    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'barang_id' => 'required',
            'qty' => 'required'
        ]);

        $barang = Barang::findOrFail($request->barang_id);
        $getCart = json_decode($request->cookie('cart'), true);

        if ($getCart) {
            if (array_key_exists($request->barang_id, $getCart)) {
                $getCart[$request->barang_id]['qty'] += $request->qty;
                return response()->json($getCart, 200)
                    ->cookie('cart', json_encode($getCart), 120);
            }
        }

        $getCart[$request->barang_id] = [
            'kodeBarang' => $barang->kodeBarang,
            'namaBarang' => $barang->namaBarang,
            'hargaJualSatuan' => $barang->hargaJualSatuan,
            'qty' => $request->qty,
            'jumlah' => $barang->hargaJualSatuan * $request->qty
        ];

        return response()->json($getCart, 200)
            ->cookie('cart', json_encode($getCart), 120);
    }

    public function getCart()
    {
        $cart = json_decode(request()->cookie('cart'), true);
        return response()->json($cart, 200);
    }

    public function getTotal(Request $request)
    {
        $cart = json_decode($request->cookie('cart'), true);
        $result = collect($cart)->map(function($value) {
            return [
                'kodeBarang' => $value['kodeBarang'],
                'namaBarang' => $value['namaBarang'],
                'qty' => $value['qty'],
                'hargaJualSatuan' => $value['hargaJualSatuan'],
                'result' => $value['hargaJualSatuan'] * $value['qty']
            ];
        })->all();
        $total = array_sum(array_column($result, 'result'));
        $json = ['total' => $total];
        return response()->json($json, 200);
    }

    public function removeCart($id)
    {
        $cart = json_decode(request()->cookie('cart'), true);
        unset($cart[$id]);
        return response()->json($cart, 200)->cookie('cart', json_encode($cart), 120);
    }

    public function storeOrder(Request $request)
    {
        $invoice = Order::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(5)) , 5,"0") as invoice')->first();
        $code_invoice = date('Ym').'/INV/'.$invoice->invoice;
        $cart = json_decode($request->cookie('cart'), true);
        $result = collect($cart)->map(function($value) {
            return [
                'kodeBarang' => $value['kodeBarang'],
                'namaBarang' => $value['namaBarang'],
                'qty' => $value['qty'],
                'hargaJualSatuan' => $value['hargaJualSatuan'],
                'result' => $value['hargaJualSatuan'] * $value['qty']
            ];
        })->all();

        DB::beginTransaction();
        try {
            $order = Order::create([
                'invoice' => $code_invoice,
                'idUser' => auth()->user()->id,
                'total' => array_sum(array_column($result, 'result'))
            ]);

            foreach ($result as $key => $row) {
                $order->order_detail()->create([
                    'idBarang' => $key,
                    'qty' => $row['qty'],
                    'hargaJualSatuan' => $row['hargaJualSatuan']
                ]);
            }
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => $order->invoice,
            ], 200)->cookie(Cookie::forget('cart'));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
