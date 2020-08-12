@extends('layouts.app', ['activePage' => 'kategorak', 'titlePage' => __('Pengaturan Kategori dan Lokasi Rak')])

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-md-10">
                    @if (session('message'))
                        <div class="row">
                            <div class="col-sm-12">
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
                <div class="col-md-10">
                    <div class="card card-nav-tabs card-plain">
                        <div class="card-header card-header-danger">
                            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <ul class="nav nav-tabs justify-content-center" data-tabs="tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#barang" data-toggle="tab">Kategori dan Lokasi Rak</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="tab-content">
                                <div class="tab-pane active" id="barang">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class=" text-center">Daftar Kategori Barang</h4>
                                                    <div class="text-right">
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#kategoriModal">
                                                            Tambah Kategori
                                                        </button>
                                                    </div>
                                                    <div class="modal fade" id="kategoriModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="post" action="{{ route('kategori.store') }}" autocomplete="off" class="form-horizontal">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="stockModalLabel">Tambah Kategori</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group {{ $errors->has('namaKategori') ? ' has-danger' : '' }}">
                                                                            <label for="namaKategori" class="bmd-label-static">Nama Kategori</label>
                                                                            <input type="text" class="form-control {{ $errors->has('namaKategori') ? ' is-invalid' : '' }}" id="namaKategori" name="namaKategori">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>Nama Kategori</th>
                                                            <th>Jumlah Barang</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @forelse($kategori as $k)
                                                            <tr>
                                                                <td>{{ $k->namaKategori }}</td>
                                                                <td>{{ $k->hitungKategori }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                Belum ada Kategori
                                                            </tr>
                                                        @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class=" text-center">Daftar Lokasi Barang</h4>
                                                    <div class="text-right">
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rakModal">
                                                            Tambah Rak
                                                        </button>
                                                    </div>
                                                    <div class="modal fade" id="rakModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="post" action="{{ route('rak.store') }}" autocomplete="off" class="form-horizontal">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="stockModalLabel">Tambah Rak</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group {{ $errors->has('namaRak') ? ' has-danger' : '' }}">
                                                                            <label for="namaRak" class="bmd-label-static">Nama Lokasi Rak</label>
                                                                            <input type="text" class="form-control {{ $errors->has('namaRak') ? ' is-invalid' : '' }}" id="namaRak" name="namaRak">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>Nama Lokasi Rak</th>
                                                            <th>Jumlah pada Rak</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @forelse($rak as $r)
                                                            <tr>
                                                                <td>{{ $r->namaRak }}</td>
                                                                <td>{{ $r->hitungBarang }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                Belum ada Lokasi Rak
                                                            </tr>
                                                        @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
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
