@extends('layouts.app', ['activePage' => 'barang', 'titlePage' => __('Barang Masuk')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">

                    <div class="card card-nav-tabs card-plain">
                        <div class="card-header card-header-danger">
                            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#home" data-toggle="tab">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#updates" data-toggle="tab">Updates</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#history" data-toggle="tab">History</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="tab-content text-center">
                                <div class="tab-pane active" id="home">
                                    <div class="text-right">
                                        <a href="{{ route('barang.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group {{ $errors->has('kodeBarang') ? ' has-danger' : '' }} col-md-4">
                                            <label for="kodeBarang" class="bmd-label-floating" style="color: black">Kode Barang</label>
                                            <input type="text" class="form-control {{ $errors->has('kodeBarang') ? ' is-invalid' : '' }}" id="kodeBarang" name="kodeBarang" value="{{ $data->kodeBarang }}" readonly>
{{--                                            <small id="KSHelp" class="form-text text-muted">Diisi dengan Kode Barang</small>--}}
                                        </div>

                                        <div class="form-group {{ $errors->has('namaBarang') ? ' has-danger' : '' }} col-md-4">
                                            <label for="namaBarang" class="bmd-label-floating" style="color: black">Nama Barang</label>
                                            <input type="text" class="form-control {{ $errors->has('namaBarang') ? ' is-invalid' : '' }}" id="namaBarang" name="namaBarang" value="{{ $data->namaBarang }}" readonly>
{{--                                            <small id="KSHelp" class="form-text text-muted">Diisi dengan Nama Barang</small>--}}
                                        </div>

                                        <div class="form-group {{ $errors->has('namaBarang') ? ' has-danger' : '' }} col-md-4">
                                            <label for="idKategori" class="bmd-label-floating" style="color: black">Kategori</label>
                                            <input type="text" class="form-control {{ $errors->has('idKategori') ? ' is-invalid' : '' }}" id="idKategori" name="idKategori" value="{{ $kategori->namaKategori }}" readonly>
{{--                                            <small id="KSHelp" class="form-text text-muted">Diisi dengan Nama Barang</small>--}}
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        {{--                                <div class="form-group {{ $errors->has('hargaBeli') ? ' has-danger' : '' }} col-md-2">--}}
                                        {{--                                    <label for="hargaBeli" class="bmd-label-static">Harga Beli</label>--}}
                                        {{--                                    <input type="number" class="form-control {{ $errors->has('hargaBeli') ? ' is-invalid' : '' }}" id="hargaBeli" name="hargaBeli" value="{{ $data->hargaBeli }}" readonly>--}}
                                        {{--                                    <small id="KSHelp" class="form-text text-muted">Harga Beli dari Supplier</small>--}}
                                        {{--                                </div>--}}

                                        <div class="form-group {{ $errors->has('hargaJualSatuan') ? ' has-danger' : '' }} col-md-4">
                                            <label for="hargaJualSatuan" class="bmd-label-floating" style="color: black">Harga Jual Satuan</label>
                                            <input type="number" class="form-control {{ $errors->has('hargaJualSatuan') ? ' is-invalid' : '' }}" id="hargaJualSatuan" name="hargaJualSatuan" value="{{ $data->hargaJualSatuan }}" readonly>
{{--                                            <small id="KSHelp" class="form-text text-muted">Harga Satuan Barang</small>--}}
                                        </div>

                                        <div class="form-group {{ $errors->has('satuan') ? ' has-danger' : '' }} col-md-2">
                                            <label for="satuan" class="bmd-label-floating" style="color: black">Satuan</label>
                                            <input type="text" class="form-control {{ $errors->has('satuan') ? ' is-invalid' : '' }}" id="satuan" name="satuan" value="{{ $data->satuan }}" readonly>
{{--                                            <small id="KSHelp" class="form-text text-muted">Cth : PCS, BJ, BUAH</small>--}}
                                        </div>

                                        <div class="form-group {{ $errors->has('stock') ? ' has-danger' : '' }} col-md-2">
                                            <label for="stock" class="bmd-label-floating" style="color: black">Stock</label>
                                            <input type="number" class="form-control {{ $errors->has('stock') ? ' is-invalid' : '' }}" id="stock" name="stock" value="{{ $data->stock }}" readonly>
{{--                                            <small id="KSHelp" class="form-text text-muted">Stok dlm satuan</small>--}}
                                        </div>

                                        <div class="form-group {{ $errors->has('minStock') ? ' has-danger' : '' }} col-md-2">
                                            <label for="minStock" class="bmd-label-floating" style="color: black">Minimal Stock</label>
                                            <input type="number" class="form-control {{ $errors->has('minStock') ? ' is-invalid' : '' }}" id="minStock" name="minStock" value="{{ $data->minStock }}" readonly>
{{--                                            <small id="KSHelp" class="form-text text-muted">Minimal stok barang</small>--}}
                                        </div>

                                        <div class="form-group {{ $errors->has('jmlPerdus') ? ' has-danger' : '' }} col-md-2">
                                            <label for="jmlPerdus" class="bmd-label-floating" style="color: black">Jumlah Perdus</label>
                                            <input type="number" class="form-control {{ $errors->has('jmlPerdus') ? ' is-invalid' : '' }}" id="jmlPerdus" name="jmlPerdus" value="{{ $data->jmlPerdus }}" readonly>
{{--                                            <small id="KSHelp" class="form-text text-muted">Jmlh per Satu Dus</small>--}}
                                        </div>
                                    </div>

                                    <a href="{{ route('barang.edit', $data->id) }}" type="submit" class="btn btn-primary">{{ __('Update') }}</a>

                                </div>
                                <div class="tab-pane" id="updates">
                                    <p> I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that&#x2019;s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that&#x2019;s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. </p>
                                </div>
                                <div class="tab-pane" id="history">
                                    <p> I think that&#x2019;s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that&#x2019;s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
                                </div>
                            </div>
                        </div>
                    </div>

{{--                    <div class="card ">--}}
{{--                        <div class="card-header card-header-primary">--}}
{{--                            <h4 class="card-title">{{ $data->namaBarang }}</h4>--}}
{{--                            <p class="card-category">{{ __('Data Barang') }}</p>--}}
{{--                        </div>--}}

{{--                        <div class="card-body">--}}
{{--                        </div>--}}
{{--                        <div class="card-footer ml-auto mr-auto">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
