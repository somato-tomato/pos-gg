<?php

namespace App\Http\Controllers;

use App\BarangRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangRuleController extends Controller
{
    public function addRule(Request $request)
    {
        $request->validate([
            'idBarang' => 'required',
            'jumlahBeli' => 'required',
            'discount' => 'required'
        ]);

        $form_data = array(
            'idBarang' => $request->idBarang,
            'jumlahBeli' => $request->jumlahBeli,
            'discount' => $request->discount
        );

        BarangRule::create($form_data);

        return back()->with('message', 'Discount berhasil ditambah!');
    }

    public function upStatusDown($id)
    {
        $disc = DB::table('barang_rules')
                    ->select('discount')
                    ->where('id', '=', $id)
                    ->first();

        DB::table('barang_rules')
            ->where('id', '=', $id)
            ->update(['status' => 1]);

        return back()->with('messageError', 'Discount '.$disc->discount.'% di nonAktifkan!');
    }

    public function upStatusUp($id)
    {
        $disc = DB::table('barang_rules')
            ->select('discount')
            ->where('id', '=', $id)
            ->first();

        DB::table('barang_rules')
            ->where('id', '=', $id)
            ->update(['status' => 0]);

        return back()->with('messageError', 'Discount '.$disc->discount.'% di Aktifkan!');
    }

    public function deleteDisc($id)
    {
        DB::table('barang_rules')->where('id', '=', $id)->delete();

        return back()->with('message', 'Discount berhasil dihapus!');
    }
}
