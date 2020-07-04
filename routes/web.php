<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    //ROUTE SUPPLIER BARANG
    Route::get('barang-supplier/list-barang', 'BarangSupplierController@loadBarang')->name('bSupplier.loadBarang');
    Route::get('barang-supplier/list-supplier', 'BarangSupplierController@loadSupplier')->name('bSupplier.loadSupplier');
    Route::post('barang-supplier/update', 'BarangSupplierController@update')->name('bSupplier.update');
    Route::post('barang-supplier/save', 'BarangSupplierController@store')->name('bSupplier.store');
    Route::get('barang-supplier/create', 'BarangSupplierController@create')->name('bSupplier.create');
    Route::get('barang-supplier/get-barang-supplier', 'BarangSupplierController@getBarangSupplier')->name('bSupplier.getbSupplier');
    Route::get('barang-supplier/', 'BarangSupplierController@index')->name('bSupplier.index');
    //ROUTE STOCK BARANG MASUK
    Route::get('barang/{id}/supplier', 'BarangStockController@getSupplier')->name('stock.supp');
    Route::get('barang/get-stock-kurang', 'BarangStockController@getStockWarn')->name('stock.getStockWarn');
    Route::get('barang/stock-kurang', 'BarangStockController@stockWarn')->name('stock.warn');
    Route::post('barang/tambah', 'BarangStockController@stockAdd')->name('stock.nambah');
    //ROUTE RAK
    Route::post('barang/rak/list-rak/store', 'KategoriRakController@rakBarangStore')->name('rak.storeRakBarang');
    Route::get('barang/rak/list-rak', 'KategoriRakController@getListRak')->name('rak.getList');
    Route::post('barang/rak/store', 'KategoriRakController@rakStore')->name('rak.store');
    Route::get('barang/rak/get-rak', 'KategoriRakController@getRak')->name('rak.getRak');
    Route::get('barang/rak', 'KategoriRakController@rakDex')->name('rak.dex');
    //ROUTE KATEGORI
    Route::post('barang/kategori/store', 'KategoriRakController@kategoriStore')->name('kategori.store');
    Route::get('barang/kategori/get-kategori', 'KategoriRakController@getKategori')->name('kategori.getKategori');
    Route::get('barang/kategori', 'KategoriRakController@kategoriDex')->name('kategori.dex');
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
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

