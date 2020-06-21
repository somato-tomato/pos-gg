@extends('layouts.app', ['activePage' => 'barang', 'titlePage' => __('Barang Masuk')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" autocomplete="off" class="form-horizontal" action="{{ route('barang.update', $data->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ $data->namaBarang }}</h4>
                                <p class="card-category">{{ __('Data Barang') }}</p>
                            </div>

                            <div class="card-body">
                                <div class="text-right">
                                    <a href="{{ route('barang.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                                </div>

                                <div class="form-row">
                                    <div class="form-group {{ $errors->has('kodeSupplier') ? ' has-danger' : '' }} col-md-6">
                                        <label for="kodeSupplier" class="bmd-label-static">Kode Supplier</label>
                                        <input type="text" class="form-control {{ $errors->has('kodeSupplier') ? ' is-invalid' : '' }}" id="kodeSupplier" name="kodeSupplier" value="{{ $data->kodeSupplier }}" readonly>
                                        <small id="KSHelp" class="form-text text-muted">Diisi dengan memilih Kode Supplier</small>
                                    </div>

                                    <div class="form-group {{ $errors->has('kodeBarang') ? ' has-danger' : '' }} col-md-6">
                                        <label for="kodeBarang" class="bmd-label-static">Kode Barang</label>
                                        <input type="text" class="form-control {{ $errors->has('kodeBarang') ? ' is-invalid' : '' }}" id="kodeBarang" name="kodeBarang" value="{{ $data->kodeBarang }}">
                                        <small id="KSHelp" class="form-text text-muted">Diisi dengan Kode Barang</small>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group {{ $errors->has('namaBarang') ? ' has-danger' : '' }} col-md-6">
                                        <label for="namaBarang" class="bmd-label-static">Nama Barang</label>
                                        <input type="text" class="form-control {{ $errors->has('namaBarang') ? ' is-invalid' : '' }}" id="namaBarang" name="namaBarang" value="{{ $data->namaBarang }}">
                                        <small id="KSHelp" class="form-text text-muted">Diisi dengan Nama Barang</small>
                                    </div>

                                    <div class="form-group {{ $errors->has('kategori') ? ' has-danger' : '' }} col-md-6">
                                        <label for="kategori" class="bmd-label-static">Kategori</label>
                                        <input type="text" class="form-control {{ $errors->has('kategori') ? ' is-invalid' : '' }}" id="kategori" name="kategori" value="{{ $data->kategori }}">
                                        <small id="KSHelp" class="form-text text-muted">Diisi dengan Kategori dari Barang</small>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group {{ $errors->has('hargaBeli') ? ' has-danger' : '' }} col-md-2">
                                        <label for="hargaBeli" class="bmd-label-static">Harga Beli</label>
                                        <input type="number" class="form-control {{ $errors->has('hargaBeli') ? ' is-invalid' : '' }}" id="hargaBeli" name="hargaBeli" value="{{ $data->hargaBeli }}">
                                        <small id="KSHelp" class="form-text text-muted">Harga Beli dari Supplier</small>
                                    </div>

                                    <div class="form-group {{ $errors->has('hargaJualSatuan') ? ' has-danger' : '' }} col-md-2">
                                        <label for="hargaJualSatuan" class="bmd-label-static">Harga Jual Satuan</label>
                                        <input type="number" class="form-control {{ $errors->has('hargaJualSatuan') ? ' is-invalid' : '' }}" id="hargaJualSatuan" name="hargaJualSatuan" value="{{ $data->hargaJualSatuan }}">
                                        <small id="KSHelp" class="form-text text-muted">Harga Satuan Barang</small>
                                    </div>

                                    <div class="form-group {{ $errors->has('satuan') ? ' has-danger' : '' }} col-md-2">
                                        <label for="satuan" class="bmd-label-static">Satuan</label>
                                        <input type="text" class="form-control {{ $errors->has('satuan') ? ' is-invalid' : '' }}" id="satuan" name="satuan" value="{{ $data->satuan }}">
                                        <small id="KSHelp" class="form-text text-muted">Cth : PCS, BJ, BUAH</small>
                                    </div>

                                    <div class="form-group {{ $errors->has('stock') ? ' has-danger' : '' }} col-md-2">
                                        <label for="stock" class="bmd-label-static">Stock Awal</label>
                                        <input type="number" class="form-control {{ $errors->has('stock') ? ' is-invalid' : '' }}" id="stock" name="stock" value="{{ $data->stock }}">
                                        <small id="KSHelp" class="form-text text-muted">Stok awal dlm satuan</small>
                                    </div>

                                    <div class="form-group {{ $errors->has('minStock') ? ' has-danger' : '' }} col-md-2">
                                        <label for="minStock" class="bmd-label-static">Minimal Stock</label>
                                        <input type="number" class="form-control {{ $errors->has('minStock') ? ' is-invalid' : '' }}" id="minStock" name="minStock" value="{{ $data->minStock }}">
                                        <small id="KSHelp" class="form-text text-muted">Minimal stok barang</small>
                                    </div>

                                    <div class="form-group {{ $errors->has('jmlPerdus') ? ' has-danger' : '' }} col-md-2">
                                        <label for="jmlPerdus" class="bmd-label-static">Jumlah Perdus</label>
                                        <input type="number" class="form-control {{ $errors->has('jmlPerdus') ? ' is-invalid' : '' }}" id="jmlPerdus" name="jmlPerdus" value="{{ $data->jmlPerdus }}">
                                        <small id="KSHelp" class="form-text text-muted">Jmlh per Satu Dus</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
