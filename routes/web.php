<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/test', function (){
    return view('test');
});

Route::post('/test/post', function (Request $request){

    $existBarang = DB::table('test_rule')
        ->where([['id_barang', $request->id_barang], ['jumlah', $request->jumlah]])
        ->exists();

    if ($existBarang)
    {
        $test = DB::table('test_rule')
            ->select('harga')
            ->first();

        echo $test->harga;
    } else {
        $test = DB::table('test_rule')
            ->select('harga')
            ->where([['jumlah', 1], ['id_barang', $request->id_barang]])
            ->first();

        $total = $test->harga * $request->jumlah;

        echo $total;
    }
})->name('test');

Route::group(['middleware' => 'auth'], function () {
    //ROUTE ORDER / TRANSAKSI NO JS
//    Route::get('noJS/struk/{invoice}', 'OrderDbController@printStruk')->name('noJS.struk');
    Route::get('noJS/final/{invoice}', 'OrderDbController@kwitansi')->name('noJS.kwitansi');
    Route::put('noJS/order/{id}/process', 'OrderDbController@bayarOrder')->name('noJS.order');
    Route::post('noJS/save-cart', 'OrderDbController@storeCart')->name('noJS.cart');
    Route::get('noJS/{invoice}', 'OrderDbController@second')->name('noJS.second');
    Route::post('noJS/save-invoice', 'OrderDbController@createInvoice')->name('noJS.invoice');
    Route::get('noJS/', 'OrderDbController@first')->name('noJS.first');
    //ROUTE ORDER / TRANSAKSI
    Route::post('transaksi/checkout', 'OrderController@storeOrder')->name('trans.order');
    Route::get('transaksi/', 'OrderController@orderAdd')->name('trans.dex');
    //ROUTE SUPPLIER BARANG
    Route::get('barang-supplier/list-barang', 'BarangSupplierController@loadBarang')->name('bSupplier.loadBarang');
    Route::get('barang-supplier/list-supplier', 'BarangSupplierController@loadSupplier')->name('bSupplier.loadSupplier');
    Route::post('barang-supplier/update', 'BarangSupplierController@update')->name('bSupplier.update');
    Route::post('barang-supplier/save', 'BarangSupplierController@store')->name('bSupplier.store');
    Route::get('barang-supplier/get-barang-supplier', 'BarangSupplierController@getBarangSupplier')->name('bSupplier.getbSupplier');
    Route::get('barang-supplier/', 'BarangSupplierController@index')->name('bSupplier.index');
    //ROUTE STOCK BARANG MASUK
    Route::get('barang/{id}/supplier', 'BarangStockController@getSupplier')->name('stock.supp');
    Route::get('barang/get-stock-kurang', 'BarangStockController@getStockWarn')->name('stock.getStockWarn');
    Route::get('barang/stock-kurang', 'BarangStockController@stockWarn')->name('stock.warn');
    Route::post('barang/tambah', 'BarangStockController@stockAdd')->name('stock.nambah');

    //ROUTE KATEGORAK
    Route::get('kategori-rak', 'KategoriRakController@kategorakDex')->name('kategorak.dex');

    //ROUTE RAK
    Route::post('barang/rak/list-rak/store', 'KategoriRakController@rakBarangStore')->name('rak.storeRakBarang');
    Route::get('barang/rak/list-rak', 'KategoriRakController@getListRak')->name('rak.getList');
    Route::post('barang/rak/store', 'KategoriRakController@rakStore')->name('rak.store');
    //ROUTE KATEGORI
    Route::post('barang/kategori/store', 'KategoriRakController@kategoriStore')->name('kategori.store');
    Route::get('barang/kategori/list-kategori', 'KategoriRakController@getListKategori')->name('kategori.getList');

    //ROUTE BARANG RULE
    Route::delete('barang/rule/{id}/delete', 'BarangRuleController@deleteDisc')->name('rule.delete');
    Route::put('barang/rule/{id}/aktif', 'BarangRuleController@upStatusUp')->name('rule.aktif');
    Route::put('barang/rule/{id}/non-aktif', 'BarangRuleController@upStatusDown')->name('rule.nonAktif');
    Route::post('barang/save-kategori-rak', 'KategoriRakController@saveKategoriRak')->name('rule.addKategorak');
    Route::post('barang/{id}/rule', 'BarangRuleController@addRule')->name('rule.add');
    //ROUTE BARANG
    Route::put('barang/{id}/update', 'BarangController@update')->name('barang.update');
    Route::get('barang/{id}/edit', 'BarangController@edit')->name('barang.edit');
    Route::get('barang/{id}/view', 'BarangController@show')->name('barang.view');
    Route::post('barang/save/create', 'BarangController@store')->name('barang.save');
    Route::get('barang/create', 'BarangController@create')->name('barang.create');
    Route::get('barang/get-barang', 'BarangController@getBarang')->name('barang.getBarang');
    Route::get('barang/', 'BarangController@index')->name('barang.index');
    // ROUTE SUPPLIER
    Route::put('supplier/{id}/nonaktif', 'SupplierController@statDeActivated')->name('supp.nonactive');
    Route::put('supplier/{id}/aktif', 'SupplierController@statActivated')->name('supp.active');
    Route::get('supplier/get-supplier', 'SupplierController@getSupplier')->name('supp.getSupp');
    Route::resource('supplier', 'SupplierController');
    // ROUTE ROKO
    Route::resource('toko', 'TokoController');
    Route::post('transaksii/addproduct/{id}', 'transaksiController@addProductCart');
    Route::post('transaksii/clear', 'transaksiController@clear');
    Route::post('/transaksii/removeproduct/{id}', 'transaksiController@removeProductCart');
    Route::post('/transaksii/increasecart/{id}', 'transaksiController@increasecart');
    Route::post('/transaksii/increasecart1/{id}', 'transaksiController@increasecart1');
    Route::post('/transaksii/decreasecart/{id}', 'transaksiController@decreasecart');
    Route::post('/transaksii/bayar','transaksiController@bayar');
    Route::get('/transaksii/history','transaksiController@history');
    Route::get('/transaksii/laporan/{id}','transaksiController@laporan');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

