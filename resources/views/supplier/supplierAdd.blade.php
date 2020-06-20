@extends('layouts.app', ['activePage' => 'supplier', 'titlePage' => __('Tambah Supplier')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Profile') }}</h4>
                <p class="card-category">{{ __('User information') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('kode') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('kode') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('kode') ? ' is-invalid' : '' }}" kode="kode" id="input-kode" type="text" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('nama') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('nama') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" id="input-nama" type="text" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('alamat') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" id="input-alamat" type="text" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nama Kontak') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('namaKontak') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('namaKontak') ? ' is-invalid' : '' }}" name="namaKontak" id="input-namaKontak" type="text" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('No HP') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('noHp') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('NoHp') ? ' is-invalid' : '' }}" name="noHp" id="input-noHp" type="text" required />
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
