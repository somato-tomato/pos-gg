<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Supplier;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return view('barang.barangDex');
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
            'hargaJualSatuan' => 'required'
        ]);

        $form_data = array(
            'kodeSupplier'   =>  $request->kodeSupplier,
            'kodeBarang' =>  $request->kodeBarang,
            'namaBarang'     =>  $request->namaBarang,
            'kategori'   =>  $request->kategori,
            'satuan' => $request->satuan,
            'hargaBeli' => $request->hargaBeli,
            'hargaJualSatuan' => $request->hargaJualSatuan
        );
        Barang::create($form_data);

        return redirect()->route('barang.index')->with('message', 'Barang berhasil di Tambahkan');
    }

    public function show()
    {
        return view('barang.barangView');
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
