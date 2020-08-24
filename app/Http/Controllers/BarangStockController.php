<?php

namespace App\Http\Controllers;

use App\BarangStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BarangStockController extends Controller
{
    public function stockAdd(Request $request)
    {
        $request->validate([
            'idBarang'   =>  'required',
            'idSupplier' => 'required',
            'stockMasuk' =>  'required'
        ]);

        $file = $request->file('photo');
        $new_name = 'brg'.$file->getClientOriginalName();
        $file->move(public_path('files_brgStock'), $new_name);

        $form_data = array(
            'idBarang'     =>  $request->idBarang,
            'idSupplier' => $request->idSupplier,
            'stockMasuk'   =>  $request->stockMasuk,
            'keterangan'   =>  $request->keterangan,
            'photo' => $request->new_name
        );

        DB::table('barangs')
            ->where('id', '=', $request->idBarang)
            ->increment('stock', $request->stockMasuk);

        BarangStock::create($form_data);

        return back()->with('message', 'Stock '.$request->namaBarang.' berhasil di tambah');
    }

    public function stockWarn()
    {
        $kurang = DB::table('barangs')
            ->whereRaw('stock <= minStock')
            ->pluck('namaBarang', 'id');

        $kurang->prepend('Pilih Barang', '0');

        return view('barang.stock.minStockDex', compact('kurang'));
    }

    public function getStockWarn()
    {
        $data = DB::table('barangs')
            ->select('id', 'kodeBarang', 'namaBarang', 'stock', 'minStock')
            ->whereRaw('stock <= minStock');

        return Datatables::of($data)->make(true);
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

    public function stockView()
    {
        $kurang = DB::table('barangs')
            ->pluck('namaBarang', 'id');

        $kurang->prepend('Pilih Barang', '0');

        return view('barang.stock.listStockDex', compact('kurang'));
    }

    public function getStock()
    {
        $data = DB::table('barangs')
            ->select('id', 'kodeBarang', 'namaBarang', 'stock')
            ->get();

        return DataTables::of($data)->make(true);
    }

}
