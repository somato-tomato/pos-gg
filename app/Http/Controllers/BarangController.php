<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $data = DB::table('barangs')
            ->join('suppliers', 'barangs.kodeSupplier', '=', 'suppliers.id')
            ->select('barangs.id', 'barangs.kodeBarang', 'barangs.namaBarang', 'suppliers.namaSupplier','barangs.hargaJualSatuan', 'barangs.stock', 'barangs.minStock')
            ->get();

//        $data = Barang::orderby('created_at', 'desc')->paginate(5);

        return view('barang.barangDex', compact('data'));
    }

    public function create()
    {
        return view('barang.barangAdd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodeSupplier'   =>  'required',
            'kodeBarang' => 'required|unique:barangs',
            'namaBarang' =>  'required',
            'kategori'   =>  'required',
            'satuan' =>  'required',
            'hargaBeli' => 'required',
            'hargaJualSatuan' => 'required',
            'stock' => 'required',
            'minStock' => 'required',
            'jmlPerdus' => 'required'
        ]);

        $form_data = array(
            'kodeSupplier'   =>  $request->kodeSupplier,
            'kodeBarang' =>  $request->kodeBarang,
            'namaBarang'     =>  $request->namaBarang,
            'kategori'   =>  $request->kategori,
            'satuan' => $request->satuan,
            'hargaBeli' => $request->hargaBeli,
            'hargaJualSatuan' => $request->hargaJualSatuan,
            'stock' => $request->stock,
            'minStock' => $request->minStock,
            'jmlPerdus' => $request->jmlPerdus
        );

        Barang::create($form_data);

        return redirect()->route('barang.index')->with('message', 'Barang berhasil di Tambahkan');
    }

    public function show($id)
    {
        $data = Barang::findOrFail($id);
        return view('barang.barangView', compact('data'));
    }

    public function edit()
    {
        return view('barang.barangUp');
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
