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
            'idSupplier' => 'required',
            'stockMasuk' =>  'required'
        ]);

        $form_data = array(
            'idBarang'     =>  $request->idBarang,
            'idSupplier' => $request->idSupplier,
            'stockMasuk'   =>  $request->stockMasuk,
            'keterangan'   =>  $request->keterangan
        );

//        ddd($form_data);

        DB::table('barangs')
            ->where('id', '=', $request->idBarang)
            ->increment('stock', $request->stockMasuk);

        BarangStock::create($form_data);

        return back()->with('message', 'Stock '.$request->namaBarang.' berhasil di tambah');
    }

    public function stockWarn()
    {
        $data = DB::table('barangs')
            ->select('id', 'kodeBarang', 'namaBarang', 'stock', 'minStock')
            ->whereRaw('stock <= minStock')
            ->get();

        $kurang = DB::table('barangs')
            ->whereRaw('stock <= minStock')
            ->pluck('namaBarang', 'id');

        $kurang->prepend('Pilih Barang', '0');

        return view('barang.stock.minStockDex', compact('data', 'kurang'));
    }

    public function getSupplier($id)
    {
        $supplier = DB::table('barang_suppliers')
            ->join('suppliers', 'barang_suppliers.idSupplier', '=', 'suppliers.id')
            ->where('barang_suppliers.idBarang', $id)
            ->pluck('suppliers.namaSupplier','suppliers.id');
        $supplier->prepend('Pilih Supplier', '0');

        return json_encode($supplier);
    }

}
