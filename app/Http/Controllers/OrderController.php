<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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

        //mengambil data product berdasarkan id
        $barang = Barang::findOrFail($request->barang_id);
        //mengambil cookie cart dengan $request->cookie('cart')
        $getCart = json_decode($request->cookie('cart'), true);

        //jika datanya ada
        if ($getCart) {
            //jika key nya exists berdasarkan product_id
            if (array_key_exists($request->barang_id, $getCart)) {
                //jumlahkan qty barangnya
                $getCart[$request->barang_id]['qty'] += $request->qty;
                //dikirim kembali untuk disimpan ke cookie
                return response()->json($getCart, 200)
                    ->cookie('cart', json_encode($getCart), 120);
            }
        }

        //jika cart kosong, maka tambahkan cart baru
        $getCart[$request->barang_id] = [
            'kodeBarang' => $barang->kodeBarang,
            'namaBarang' => $barang->namaBarang,
            'hargaJualSatuan' => $barang->hargaJualSatuan,
            'qty' => $request->qty
        ];
        //kirim responsenya kemudian simpan ke cookie
        return response()->json($getCart, 200)
            ->cookie('cart', json_encode($getCart), 120);
    }

    public function getCart()
    {
        $cart = json_decode(request()->cookie('cart'), true);
        return response()->json($cart, 200);
    }

    public function removeCart($id)
    {
        $cart = json_decode(request()->cookie('cart'), true);
        //menghapus cart berdasarkan product_id
        unset($cart[$id]);
        //cart diperbaharui
        return response()->json($cart, 200)->cookie('cart', json_encode($cart), 120);
    }
}
