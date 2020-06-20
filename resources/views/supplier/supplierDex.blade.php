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
      @endif
      </div>
    <a href="{{route('supplier.create')}}" class="btn btn-primary" type="button" value="Tambah Supplier">Tambah Supplier</a>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Supplier</h4>
            <p class="card-category">Data Supplier</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    Kode
                  </th>
                  <th>
                    Nama Supplier
                  </th>
                  <th>
                    No Hp
                  </th>
                  <th>
                    Aksi
                  </th>
                </thead>
                <tbody>
                    @foreach ($data as $d)


                    <tr>
                        <td>
                        {{$d->kodeSupplier}}
                        </td>
                        <td>
                        {{$d->namaSupplier}}
                        </td>
                        <td>
                        {{$d->noHP}}
                        </td>
                        <td>
                        <a class="btn btn-info"href="{{route('supplier.show',$d->id)}}">Detail</a>
                        </td>
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

