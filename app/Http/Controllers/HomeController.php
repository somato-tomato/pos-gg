<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $countBarang = DB::table('barangs')
            ->count();

        $countKurang = DB::table('barangs')
            ->whereRaw('stock <= minStock')
            ->count();

        $countTransaksi = DB::table('orders')
            ->where('total', '!=', null)
            ->count();

        //TODO : CHECK DEMO.JS FOR CHARTS!

        return view('dashboard', compact('countBarang', 'countKurang', 'countTransaksi'));
    }
}
