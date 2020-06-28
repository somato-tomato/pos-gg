<?php

namespace App\Http\Controllers;

use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('supplier.supplierDex', compact('data'));
    }

    public function getSupplier()
    {
        $data = DB::table('suppliers')->get();

        return Datatables::of($data)
            ->editColumn('status', function ($data) {
                if ($data->aktif == 'aktif' ){
                    return
                        '<form action="{{ route(\'supp.nonactive\', $d->id) }}" method="post">
                            @csrf
                            @method("PUT")
                            <button onclick="return confirm(\'Nonaktifkan Supplier ?\')" type="submit" class="btn btn-sm btn-success">Aktif</button>
                        </form>';
                } else {
                    return '<button class="btn btn-sm btn-danger">OFF</button>';
                }
            })
            ->addColumn('lihat', function($data) {
                return "<a class='btn btn-xs btn-success' href='$data->id/detail'>Lihat</a>";
            })
            ->rawColumns(['sudah', 'belum', 'lihat'])->make(true);
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
            'noHP' => $request->noHP,
            'status' => $request->status
        );

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
        $data = Supplier::findOrFail($id);
        return view('supplier.supplierView', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Supplier::findOrFail($id);
        return view('supplier.supplierUp', compact('data'));
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
            'kodeSupplier'   =>  'required',
            'namaSupplier' =>  'required'
        ]);

        $form_data = array(
            'alamat'     =>  $request->alamat,
            'namaKontak'   =>  $request->namaKontak,
            'noHP' => $request->noHP
        );

        DB::table('suppliers')
            ->where('id', '=', $id)
            ->update($form_data);

        return redirect()->route('supplier.show', $request->id)->with('message', 'Supplier berhasil di Perbaharui');
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

    public function statActivated($id)
    {
        DB::table('suppliers')
            ->where('id', '=', $id)
            ->update(['status' => 'aktif']);

        return back()->with('message', 'Supplier di Aktifkan');
    }

    public function statDeActivated($id)
    {
        DB::table('suppliers')
            ->where('id', '=', $id)
            ->update(['status' => 'nonaktif']);

        return back()->with('messageError', 'Supplier di non-Aktifkan');
    }
}
