<?php

namespace App\Http\Controllers;

use App\Barang;
use App\BarangSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BarangSupplierController extends Controller
{
    public function loadSupplier(Request $request)
    {
        if ($request->has('q')) {
            $namaSupplier = $request->q;
            $data = DB::table('suppliers')
                ->select('id', 'namaSupplier')
                ->where([['namaSupplier', 'LIKE', "%$namaSupplier%"],['status', '=', 'aktif']])
                ->get();
            return response()->json($data);
        }
    }

    public function loadBarang(Request $request)
    {
        if ($request->has('q')) {
            $namaBarang = $request->q;
            $data = DB::table('barangs')
                ->select('id', 'namaBarang')
                ->where('namaBarang', 'LIKE', "%$namaBarang%")
                ->get();
            return response()->json($data);
        }
    }

    public function index()
    {
        return view('barang.supplier.bSupplierDex');
    }

    public function getBarangSupplier()
    {
        $data = DB::table('barang_suppliers')
            ->join('barangs', 'barang_suppliers.idBarang', '=', 'barangs.id')
            ->join('suppliers', 'barang_suppliers.idSupplier', '=', 'suppliers.id')
            ->select('barang_suppliers.id', 'barangs.namaBarang', 'suppliers.namaSupplier', 'barang_suppliers.hargaBeli');

        return Datatables::of($data)
            ->editColumn('perbarui', function ($data) {
                return
                    "<button type='button' class='btn btn-primary btn-sm'
                        data-id='".$data->id."'
                        data-namabarang='".$data->namaBarang."'
                        data-namasupplier='".$data->namaSupplier."'
                        data-hargabeli='".$data->hargaBeli."'
                        data-toggle='modal' data-target='#stockModal'>
                        Perbarui
                    </button>";
            })
            ->rawColumns(['perbarui'])->make(true);
    }

    public  function store(Request $request)
    {
        $request->validate([
            'idBarang'   =>  'required',
            'idSupplier' =>  'required',
            'hargaBeli' => 'required'
        ]);

        $form_data = array(
            'idBarang'     =>  $request->idBarang,
            'idSupplier'   =>  $request->idSupplier,
            'hargaBeli'   =>  $request->hargaBeli
        );

        BarangSupplier::create($form_data);

        return back()->with('message', 'Supplier Barang berhasil ditambahkan!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'idBarang'   =>  'required',
            'idSupplier' =>  'required',
            'hargaBeli' => 'required'
        ]);

        $form_data = array(
            'id' => $request->id,
            'idBarang'     =>  $request->idBarang,
            'idSupplier'   =>  $request->idSupplier,
            'hargaBeli'   =>  $request->hargaBeli
        );

        BarangSupplier::whereId($request->id)->update($form_data);

        return back()->with('message', 'Supplier Barang berhasil di perbaharui');
    }
}
