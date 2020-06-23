<?php

namespace App\Http\Controllers;

use App\BarangStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangStockController extends Controller
{
    public function stockAdd(Request $request)
    {
        $request->validate([
            'idBarang'   =>  'required',
            'stockMasuk' =>  'required'
        ]);

        $form_data = array(
            'idBarang'     =>  $request->idBarang,
            'namaBarang'   =>  $request->namaBarang,
            'stockMasuk'   =>  $request->stockMasuk,
            'keterangan'   =>  $request->keterangan
        );

        DB::table('barangs')
            ->where('id', '=', $request->idBarang)
            ->increment('stock', $request->stockMasuk);

        BarangStock::create($form_data);

        return back()->with('message', 'Stock '.$request->namaBarang.' berhasil di tambah');
    }

    public function stockWarn()
    {
        $data = DB::table('barangs')
            ->join('suppliers', 'barangs.idSupplier', '=', 'suppliers.id')
            ->select('barangs.id', 'barangs.kodeBarang', 'barangs.namaBarang', 'suppliers.namaSupplier', 'barangs.stock', 'barangs.minStock')
            ->whereRaw('barangs.stock <= barangs.minStock')
            ->get();

        return view('barang.stock.minStockDex', compact('data'));
    }

}
