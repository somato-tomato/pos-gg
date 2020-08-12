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

    public function kategorakDex()
    {
        $kategori = DB::table('kategoris')
            ->leftJoin('barangs', 'kategoris.id', '=', 'barangs.idKategori')
            ->select('kategoris.namaKategori', DB::raw('count(barangs.idKategori) as hitungKategori'))
            ->groupBy(DB::Raw('IFNULL( kategoris.namaKategori , 0 )'))
            ->get();

        $rak = DB::table('raks')
            ->leftJoin('barang_raks', 'raks.id', '=', 'barang_raks.idRak')
            ->leftJoin('barangs', 'barang_raks.idBarang', '=', 'barangs.id')
            ->select('raks.namaRak', DB::raw('count(barang_raks.idBarang) as hitungBarang'))
            ->groupBy(DB::Raw('IFNULL( raks.namaRak , 0 )'))
            ->get();

        return view('barang.kategorak.kategorakDex', compact('kategori', 'rak'));
    }

    public function getListKategori(Request $request)
    {
        if ($request->has('q')) {
            $namaKategori = $request->q;
            $data = DB::table('kategoris')
                ->select('id', 'namaKategori')
                ->where('namakategori', 'LIKE', "%$namaKategori%")
                ->get();
            return response()->json($data);
        }
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

    public function saveKategoriRak(Request $request)
    {
        $form_data = array(
            'idBarang' => $request->idBarang,
            'idKategori' => $request->idKategori,
            'idRak' => $request->idRak
        );

        if ($form_data['idKategori'] == null && $form_data['idRak'] == null)
        {
            return back()->with('messageError', 'Tidak ada yang berubah!');
        } else if ($form_data['idKategori'] == true && $form_data['idRak'] == null)
        {
            DB::table('barangs')
                ->where('id', '=' , $request->idBarang)
                ->update(['idKategori' => $request->idKategori]);

            return back()->with('message', 'Kategori berhasil dirubah');
        } else if ($form_data['idKategori'] == null && $form_data['idRak'] == true)
        {
            DB::table('barang_raks')
                ->updateOrInsert(
                    ['idBarang' => $request->idBarang],
                    ['idRak' => $request->idRak]
                );

            return back()->with('message', 'Lokasi Rak berhasil dirubah');
        } else {
            DB::table('barangs')
                ->where('id', '=' , $request->idBarang)
                ->update(['idKategori' => $request->idKategori]);

            DB::table('barang_raks')
                ->updateOrInsert(
                    ['idBarang' => $request->idBarang],
                    ['idRak' => $request->idRak]
                );

            return back()->with('message', 'Kategori dan Lokasi Rak berhasil dirubah');
        }
    }

}
