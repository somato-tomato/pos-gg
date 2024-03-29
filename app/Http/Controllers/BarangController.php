<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    public function index()
    {
        return view('barang.barangDex');
    }

    public function getBarang()
    {
        $data = DB::table('barangs')
            ->select('id', 'kodeBarang', 'namaBarang','hargaJualSatuan', 'stock');

        return Datatables::of($data)
            ->addColumn('lihat', function($data) {
                return '<a class="btn btn-xs btn-success" href="'.route('barang.view', $data->id).'">Lihat</a>';
            })
            ->rawColumns(['lihat'])->make(true);
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
            'satuan' =>  'required',
            'hargaJualSatuan' => 'required',
            'stock' => 'required',
            'minStock' => 'required',
            'jmlPerdus' => 'required'
        ]);

        $file = $request->file('photo');
        $new_name = 'brg'.$file->getClientOriginalName();
        $file->move(public_path('files_brg'), $new_name);

        $form_data = array(
            'kodeBarang' =>  $request->kodeBarang,
            'namaBarang'     =>  $request->namaBarang,
            'satuan' => $request->satuan,
            'hargaJualSatuan' => $request->hargaJualSatuan,
            'stock' => $request->stock,
            'minStock' => $request->minStock,
            'jmlPerdus' => $request->jmlPerdus,
            'photo' => $new_name
        );

        Barang::create($form_data);

        return redirect()->route('barang.index')->with('message', 'Barang berhasil di Tambahkan');
    }

    public function show($id)
    {
        $data = Barang::findOrFail($id);
        $kategori = DB::table('barangs')
            ->join('kategoris', 'barangs.idKategori', '=', 'kategoris.id')
            ->select('kategoris.namaKategori')
            ->where('barangs.id', '=', $id)
            ->first();

        $rak = DB::table('raks')
            ->join('barang_raks', 'raks.id', '=', 'barang_raks.idRak')
            ->join('barangs', 'barang_raks.idBarang', '=', 'barangs.id')
            ->where('barangs.id', '=', $id)
            ->select('raks.namaRak')->first();

        $discount = DB::table('barang_rules')
            ->select('id', 'jumlahBeli', 'discount', 'status')
            ->where('idBarang', '=', $id)
            ->get();

        $supplier = DB::table('barang_suppliers')
            ->join('barangs', 'barang_suppliers.idBarang', '=', 'barangs.id')
            ->join('suppliers', 'barang_suppliers.idSupplier', '=', 'suppliers.id')
            ->where('barangs.id', '=', $id)
            ->select('barang_suppliers.id', 'suppliers.namaSupplier', 'barang_suppliers.hargaBeli')->get();
        return view('barang.barangView', compact('data','kategori', 'discount', 'rak', 'supplier'));
    }

    public function edit($id)
    {
        $data = Barang::findOrFail($id);
        $kategori = DB::table('kategoris')->pluck('namaKategori', 'id');
        $kategori->prepend('Pilih Kategori Barang','1');
        return view('barang.barangUp', compact('data', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idKategori' => 'required',
            'kodeBarang' => 'required',
            'namaBarang' =>  'required',
            'satuan' =>  'required',
            'hargaJualSatuan' => 'required',
            'stock' => 'required',
            'minStock' => 'required',
            'jmlPerdus' => 'required'
        ]);

        $form_data = array(
            'idKategori' => $request->idKategori,
            'kodeBarang' =>  $request->kodeBarang,
            'namaBarang'     =>  $request->namaBarang,
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
