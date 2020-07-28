@extends('layouts.app', ['activePage' => 'toko', 'titlePage' => __('Profil Toko')])

@section('content')
    <div class="content" id="dw">
        <div class="container-fluid">

            <div class="col-md-12">
                @if (session('message'))
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span>{{ session('message') }}</span>
                            </div>
                        </div>
                    </div>
                @elseif (session('messageError'))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span>{{ session('messageError') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Data Toko') }}</h4>
                            <p class="card-category">{{ __('Profil Toko') }}</p>
                        </div>

                        <div class="card-body">
                            <div class="text-right">
                                <a href="{{ route('toko.edit', $toko->id) }}" class="btn btn-sm btn-warning">Perbaharui</a>
                            </div>

                            <div class="form-group">
                                <label for="namaToko" class="bmd-label-static">Nama Toko</label>
                                <input type="text" class="form-control" id="namaToko" name="namaToko" value="{{ $toko->namaToko }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="alamatToko" class="bmd-label-static">Alamat Supplier</label>
                                <input type="text" class="form-control" id="alamatToko" name="alamatToko" value="{{ $toko->alamatToko }}" disabled>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nomorToko" class="bmd-label-static">Nomor Telepon</label>
                                        <input type="number" class="form-control" id="nomorToko" name="nomorToko" value="{{ $toko->nomorToko }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="emailToko" class="bmd-label-static">Email Toko</label>
                                        <input type="email" class="form-control" id="emailToko" name="emailToko" value="{{ $toko->emailToko }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="websiteToko" class="bmd-label-static">Website</label>
                                        <input type="text" class="form-control" id="websiteToko" name="websiteToko" value="{{ $toko->websiteToko }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

