@extends('layouts.app', ['activePage' => 'supplier', 'titlePage' => __('Tambah Supplier')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ $data->namaSupplier }}</h4>
                            <p class="card-category">Data Supplier - Status <strong>{{ $data->status }}</strong></p>
                        </div>

                        <div class="card-body">
                            <div class="text-right">
                                <a href="{{ route('supplier.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                            </div>

                            <div class="form-group {{ $errors->has('kodeSupplier') ? ' has-danger' : '' }}">
                                <label for="kodeSupplier" class="bmd-label-static">Kode Supplier</label>
                                <input type="text" class="form-control {{ $errors->has('kodeSupplier') ? ' is-invalid' : '' }}" id="kodeSupplier" name="kodeSupplier" value="{{ $data->kodeSupplier }}" readonly>
                                {{--                      <small id="KSHelp" class="form-text text-muted"><i>Example</i> : KODE - NOMOR SUPPLIER</small>--}}
                            </div>

                            <div class="form-group {{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                <label for="alamat" class="bmd-label-static">Alamat Supplier</label>
                                <input type="text" class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}" id="alamat" name="alamat" value="{{ $data->alamat }}" readonly>
                            </div>

                            <div class="form-group {{ $errors->has('namaKontak') ? ' has-danger' : '' }}">
                                <label for="namaKontak" class="bmd-label-static">Nama Kontak</label>
                                <input type="text" class="form-control {{ $errors->has('namaKontak') ? ' is-invalid' : '' }}" id="namaKontak" name="namaKontak" value="{{ $data->namaKontak }}" readonly>
                            </div>

                            <div class="form-group {{ $errors->has('noHP') ? ' has-danger' : '' }}">
                                <label for="noHP" class="bmd-label-static">Nomor Telepon Genggam</label>
                                <input type="text" class="form-control {{ $errors->has('noHP') ? ' is-invalid' : '' }}" id="noHP" name="noHP" value="{{ $data->noHP }}" readonly>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <a href="{{ route('supplier.edit', $data->id) }}" type="button" class="btn btn-primary">{{ __('Update') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
