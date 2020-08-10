<?php

namespace App\Http\Controllers;

use App\BarangRule;
use Illuminate\Http\Request;

class BarangRuleController extends Controller
{
    public function addRule(Request $request)
    {
        $request->validate([
            'idBarang' => 'required',
            'jumlahBeli' => 'required',
            'harga' => 'required'
        ]);

        $form_data = array(
            'idBarang' => $request->idBarang,
            'jumlahBeli' => $request->jumlagBeli,
            'harga' => $request->harga
        );

        BarangRule::create($form_data);

        return back();
    }
}
