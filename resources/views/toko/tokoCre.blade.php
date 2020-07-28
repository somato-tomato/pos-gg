@extends('layouts.app', ['activePage' => 'toko', 'titlePage' => __('Profil Toko')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" action="{{ route('toko.store') }}" autocomplete="off" class="form-horizontal">
                        @csrf

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Data Toko') }}</h4>
                                <p class="card-category">{{ __('Konfigurasi Awal') }}</p>
                            </div>

                            <div class="card-body">
                                <div class="form-group {{ $errors->has('namaToko') ? ' has-danger' : '' }}">
                                    <label for="namaToko" class="bmd-label-static">Nama Toko</label>
                                    <input type="text" class="form-control {{ $errors->has('namaToko') ? ' is-invalid' : '' }}" id="namaToko" name="namaToko">
                                </div>

                                <div class="form-group {{ $errors->has('alamatToko') ? ' has-danger' : '' }}">
                                    <label for="alamatToko" class="bmd-label-static">Alamat Supplier</label>
                                    <input type="text" class="form-control {{ $errors->has('alamatToko') ? ' is-invalid' : '' }}" id="alamatToko" name="alamatToko">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('nomorToko') ? ' has-danger' : '' }}">
                                            <label for="nomorToko" class="bmd-label-static">Nomor Telepon</label>
                                            <input type="number" class="form-control {{ $errors->has('nomorToko') ? ' is-invalid' : '' }}" id="nomorToko" name="nomorToko">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('emailToko') ? ' has-danger' : '' }}">
                                            <label for="emailToko" class="bmd-label-static">Email Toko</label>
                                            <input type="email" class="form-control {{ $errors->has('emailToko') ? ' is-invalid' : '' }}" id="emailToko" name="emailToko">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('websiteToko') ? ' has-danger' : '' }}">
                                            <label for="websiteToko" class="bmd-label-static">Website</label>
                                            <input type="text" class="form-control {{ $errors->has('websiteToko') ? ' is-invalid' : '' }}" id="websiteToko" name="websiteToko">
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
