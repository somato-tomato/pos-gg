<?php

namespace App\Http\Controllers;

use App\BarangRak;
use App\Kategori;
use App\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class KategoriRakController extends Controller
{
    public function kategoriDex()
    {
        $kategori = DB::table('kategoris')
            ->select('namaKategori')
            ->get();

        return view('barang.kategori.kategoriDex', compact('kategori'));
    }

    public function getKategori()
    {
        $data = DB::table('kategoris')
            ->join('barangs', 'kategoris.id', '=', 'barangs.idKategori')
            ->select('barangs.kodeBarang', 'barangs.namaBarang', 'kategoris.namaKategori');

        return Datatables::of($data)->make(true);
    }

    public function kategoriStore(Request $request)
    {
        $request->validate([
            'namaKategori' => 'required|unique:kategoris'
        ]);

        $form_data = array(
            'namaKategori' =>  $request->namaKategori
        );

        Kategori::create($form_data);

        return back()->with('message', 'Kategori berhasil ditambahkan!');
    }

    public function rakDex()
    {
        $rak = DB::table('raks')
            ->select('namaRak')
            ->get();

        return view('barang.rak.rakDex', compact('rak'));
    }

    public function getRak()
    {
        $data = DB::table('raks')
            ->join('barang_raks', 'raks.id', '=', 'barang_raks.idRak')
            ->join('barangs', 'barang_raks.idBarang', '=', 'barangs.id')
            ->select('barangs.kodeBarang', 'barangs.namaBarang', 'raks.namaRak');

        return Datatables::of($data)->make(true);
    }

    public function getListRak(Request $request)
    {
        if ($request->has('q')) {
            $namaRak = $request->q;
            $data = DB::table('raks')
                ->select('id', 'namaRak')
                ->where('namaRak', 'LIKE', "%$namaRak%")
                ->get();
            return response()->json($data);
        }
    }

    public function rakStore(Request $request)
    {
        $request->validate([
            'namaRak' => 'required|unique:raks'
        ]);

        $form_data = array(
            'namaRak' =>  $request->namaRak
        );

        Rak::create($form_data);

        return back()->with('message', 'Rak berhasil ditambahkan!');
    }

    public function rakBarangStore(Request $request)
    {
        $request->validate([
            'idRak' => 'required',
            'idBarang' => 'required'
        ]);

        $form_data = array(
            'idRak' => $request->idRak,
            'idBarang' => $request->idBarang
        );

        BarangRak::create($form_data);

        return back()->with('message', 'Barang berhasil ditambahkan ke Rak Barang!');
    }

}
