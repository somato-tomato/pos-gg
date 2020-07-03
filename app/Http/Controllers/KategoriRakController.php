<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Rak;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriRakController extends Controller
{
    public function kategoriDex()
    {
        return view('barang.kategori.kategoriDex');
    }

    public function getKategori()
    {
        return Datatables::of(Kategori::query())->make(true);
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
        return view('barang.rak.rakDex');
    }

    public function getRak()
    {

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

}
