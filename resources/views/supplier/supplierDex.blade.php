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
                        <table class="table" id="supplierTable">
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
{{--DATATABLE--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
<script src="{{ asset('material/js/core/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function() {
        $('#supplierTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('supp.getSupp') }}',
            columns: [
                { data: 'kodeSupplier', name: 'kodeSupplier' },
                { data: 'namaSupplier', name: 'namaSupplier' },
                { data: 'noHP', name: 'noHP' },
                { data: 'status', name: 'status' },
                { data: 'lihat', name: 'lihat' }
            ]
        });
    });
</script>
@endsection

