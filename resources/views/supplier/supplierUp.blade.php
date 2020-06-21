@extends('layouts.app', ['activePage' => 'supplier', 'titlePage' => __('Tambah Supplier')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" action="{{ route('supplier.update', $data->id) }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('PUT')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Perbarui Supplier') }}</h4>
                                <p class="card-category">{{ __('Data Supplier') }}</p>
                            </div>

                            <div class="card-body">
                                <div class="text-right">
                                    <a href="{{ route('supplier.show', $data->id) }}" class="btn btn-sm btn-warning">Kembali</a>
                                </div>

                                <div hidden class="form-group {{ $errors->has('id') ? ' has-danger' : '' }}">
                                    <label for="id" class="bmd-label-static">Kode Supplier</label>
                                    <input type="text" class="form-control {{ $errors->has('id') ? ' is-invalid' : '' }}" id="id" name="id" value="{{ $data->id }}" readonly>
                                    {{--                      <small id="KSHelp" class="form-text text-muted"><i>Example</i> : KODE - NOMOR SUPPLIER</small>--}}
                                </div>

                                <div class="form-group {{ $errors->has('kodeSupplier') ? ' has-danger' : '' }}">
                                    <label for="kodeSupplier" class="bmd-label-static">Kode Supplier</label>
                                    <input type="text" class="form-control {{ $errors->has('kodeSupplier') ? ' is-invalid' : '' }}" id="kodeSupplier" name="kodeSupplier" value="{{ $data->kodeSupplier }}" readonly>
                                    {{--                      <small id="KSHelp" class="form-text text-muted"><i>Example</i> : KODE - NOMOR SUPPLIER</small>--}}
                                </div>

                                <div class="form-group {{ $errors->has('namaSupplier') ? ' has-danger' : '' }}">
                                    <label for="namaSupplier" class="bmd-label-static">Nama Supplier</label>
                                    <input type="text" class="form-control {{ $errors->has('namaSupplier') ? ' is-invalid' : '' }}" id="namaSupplier" name="namaSupplier" value="{{ $data->namaSupplier }}" readonly>
                                </div>

                                <div class="form-group {{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                    <label for="alamat" class="bmd-label-static">Alamat Supplier</label>
                                    <input type="text" class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}" id="alamat" name="alamat" value="{{ $data->alamat }}">
                                </div>

                                <div class="form-group {{ $errors->has('namaKontak') ? ' has-danger' : '' }}">
                                    <label for="namaKontak" class="bmd-label-static">Nama Kontak</label>
                                    <input type="text" class="form-control {{ $errors->has('namaKontak') ? ' is-invalid' : '' }}" id="namaKontak" name="namaKontak" value="{{ $data->namaKontak }}">
                                </div>

                                <div class="form-group {{ $errors->has('noHP') ? ' has-danger' : '' }}">
                                    <label for="noHP" class="bmd-label-static">Nomor Telepon Genggam</label>
                                    <input type="text" class="form-control {{ $errors->has('noHP') ? ' is-invalid' : '' }}" id="noHP" name="noHP" value="{{ $data->noHP }}">
                                </div>

                                <div hidden class="form-group {{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label for="status" class="bmd-label-static">Status</label>
                                    <input type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" id="status" name="status" value="aktif">
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Perbarui') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
