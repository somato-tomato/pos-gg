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
            ->select('id', 'kodeBarang', 'namaBarang','hargaJualSatuan', 'stock')
            ->get();

        return view('barang.barangDex', compact('data'));
    }

    public function create()
    {
        return view('barang.barangAdd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodeBarang' => 'required|unique:barangs',
            'namaBarang' =>  'required',
            'kategori'   =>  'required',
            'satuan' =>  'required',
            'hargaJualSatuan' => 'required',
            'stock' => 'required',
            'minStock' => 'required',
            'jmlPerdus' => 'required'
        ]);

        $form_data = array(
            'kodeBarang' =>  $request->kodeBarang,
            'namaBarang'     =>  $request->namaBarang,
            'kategori'   =>  $request->kategori,
            'satuan' => $request->satuan,
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

    public function edit($id)
    {
        $data = Barang::findOrFail($id);
        return view('barang.barangUp', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kodeBarang' => 'required',
            'namaBarang' =>  'required',
            'kategori'   =>  'required',
            'satuan' =>  'required',
            'hargaJualSatuan' => 'required',
            'stock' => 'required',
            'minStock' => 'required',
            'jmlPerdus' => 'required'
        ]);

        $form_data = array(
            'kodeBarang' =>  $request->kodeBarang,
            'namaBarang'     =>  $request->namaBarang,
            'kategori'   =>  $request->kategori,
            'satuan' => $request->satuan,
            'hargaJualSatuan' => $request->hargaJualSatuan,
            'stock' => $request->stock,
            'minStock' => $request->minStock,
            'jmlPerdus' => $request->jmlPerdus
        );

        DB::table('barangs')
            ->where('id', '=', $id)
            ->update($form_data);

        return redirect()->route('barang.view', $request->id)->with('message', 'Barang berhasil di Perbaharui');
    }

    public function destroy()
    {

    }
}
