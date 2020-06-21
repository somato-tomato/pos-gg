@extends('layouts.app', ['activePage' => 'supplier', 'titlePage' => __('Supplier')])

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
                    <h4 class="card-title ">Supplier</h4>
                    <p class="card-category">Data Supplier</p>
                </div>
                <div class="card-body">
                    <a href="{{ route('supplier.create') }}" class="btn btn-primary btn-sm" type="button">Tambah Supplier</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Kode Supplier
                                    </th>
                                    <th>
                                        Nama Supplier
                                    </th>
                                    <th>
                                        No HP
                                    </th>
                                    <th class="text-center">
                                        Status
                                    </th>
                                    <th class="text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td> {{$d->kodeSupplier}} </td>
                                    <td> {{$d->namaSupplier}} </td>
                                    <td> {{$d->noHP}} </td>
                                    @can('admin')
                                        <td class="text-center">
                                            @if( $d->status == 'aktif')
                                                <form action="{{ route('supp.nonactive', $d->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button onclick="return confirm('Nonaktifkan Supplier ?')" type="submit" class="btn btn-sm btn-success">Aktif</button>
                                                </form>
                                            @else
                                                <form action="{{ route('supp.active', $d->id) }}" method="post" >
                                                    @csrf
                                                    @method('PUT')
                                                    <button onclick="return confirm('Aktifkan Supplier ?')" type="submit" class="btn btn-sm btn-danger">non-aktif</button>
                                                </form>
                                            @endif
                                        </td>
                                    @endcan
                                    @can('kasir')
                                        <td class="text-center">
                                            @if( $d->status == 'aktif')
                                                <button class="btn btn-sm btn-success">AKTIF</button>
                                            @else
                                                <button class="btn btn-sm btn-danger">NON-AKTIF</button>
                                            @endif
                                        </td>
                                    @endcan
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

