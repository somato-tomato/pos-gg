@extends('layouts.app', ['activePage' => 'barang', 'titlePage' => __('Barang Masuk')])

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="col-md-12">
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

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Barang Masuk</h4>
                            <p class="card-category">Data Barang Masuk</p>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm" type="button">Tambah Barang Masuk</a>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Kode Barang
                                        </th>
                                        <th>
                                            Nama Barang
                                        </th>
                                        <th>
                                            Nama Supplier
                                        </th>
                                        <th>
                                            Harga Satuan
                                        </th>
                                        <th>
                                            Stok
                                        </th>
                                        <th>
                                            Min Stok
                                        </th>
                                        <th class="text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td> {{$d->kodeBarang}} </td>
                                            <td> {{$d->namaBarang}} </td>
                                            <td> {{$d->namaSupplier}} </td>
                                            <td> {{$d->hargaJualSatuan}} </td>
                                            <td> {{$d->stock}} </td>
                                            <td> {{$d->minStock}} </td>
                                            <td class="text-center"> <a class="btn btn-info" href="{{route('supplier.show',$d->id)}}">Detail</a> </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

