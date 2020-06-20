@extends('layouts.app', ['activePage' => 'supplier', 'titlePage' => __('Tambah Supplier')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('supplier.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            {{-- @method('put') --}}

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Tambah Supplier') }}</h4>
                <p class="card-category">{{ __('Data Supplier') }}</p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Kode Supplier') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('kodeSupplier') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('kodeSupplier') ? ' is-invalid' : '' }}" name="kodeSupplier" id="input-kode" type="text"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nama Supplier') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('namaSupplier') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('namaSupplier') ? ' is-invalid' : '' }}" name="namaSupplier" id="input-nama" type="text"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Alamat') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" id="input-alamat" type="text"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nama Kontak') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('namaKontak') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('namaKontak') ? ' is-invalid' : '' }}" name="namaKontak" id="input-namaKontak" type="text"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('No HP') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('noHP') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('NoHP') ? ' is-invalid' : '' }}" name="noHP" id="input-noHp" type="text"/>
                    </div>
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
