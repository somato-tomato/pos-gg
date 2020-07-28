<?php

namespace App\Http\Controllers;

use App\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\True_;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toko = DB::table('tokos')
            ->select('id', 'namaToko', 'alamatToko', 'nomorToko', 'emailToko', 'websiteToko')
            ->first();

        return view('toko.tokoDex', compact('toko'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('toko.tokoCre');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaToko' => 'required',
            'alamatToko' => 'required',
            'nomorToko' => 'required'
        ]);

        $form_data = array(
            'namaToko' => $request->namaToko,
            'alamatToko' => $request->alamatToko,
            'nomorToko' => $request->nomorToko,
            'emailToko' => $request->emailToko,
            'websiteToko' => $request->websiteToko
        );

        Toko::create($form_data);

        return redirect()->route('toko.index')->with('message', 'Halo, Selamat telah melakukan konfigurasi untuk Toko '. $request->namaToko);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('toko.tokoView');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toko = DB::table('tokos')
            ->where('id', '=', $id)
            ->first();

        return view('toko.tokoUp', compact('toko'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'namaToko' => 'required',
            'alamatToko' => 'required',
            'nomorToko' => 'required'
        ]);

        $form_data = array(
            'namaToko' => $request->namaToko,
            'alamatToko' => $request->alamatToko,
            'nomorToko' => $request->nomorToko,
            'emailToko' => $request->emailToko,
            'websiteToko' => $request->websiteToko
        );

        Toko::where('id', $id)->update($form_data);

        return redirect()->route('toko.index')->with('message', 'Informasi Toko '.$request->namaToko.' berhasil di perbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
