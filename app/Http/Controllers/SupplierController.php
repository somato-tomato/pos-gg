<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('suppliers')->get();
        // ddd($data);
        return view('supplier.supplierDex', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.supplierAdd');
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
            'kodeSupplier'   =>  'required',
            'namaSupplier' =>  'required',
            'alamat'   =>  'required',
            'noHP' =>  'required'
        ]);

        $form_data = array(
            'kodeSupplier'   =>  $request->kodeSupplier,
            'namaSupplier' =>  $request->namaSupplier,
            'alamat'     =>  $request->alamat,
            'namaKontak'   =>  $request->namaKontak,
            'noHP' => $request->noHP
        );

        // ddd($form_data);
        Supplier::create($form_data);

        return redirect()->route('supplier.index')->with('message', 'Supplier berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('supplier.supplierView');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('supplier.supplierUp');
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
        //
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
