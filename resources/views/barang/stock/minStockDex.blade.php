@extends('layouts.app', ['activePage' => 'minStock', 'titlePage' => __('Stock Kurang Bos')])

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
                            <h4 class="card-title ">Stock Barang Hampir Habis</h4>
                            <p class="card-category">Data Barang Hampir Habis</p>
                        </div>
                        <div class="card-body">
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
                                            Stock
                                        </th>
                                        <th>
                                            Minimal Stok
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
                                            <td> {{$d->stock}} </td>
                                            <td> {{$d->minStock}} </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm" data-idbarang="{{ $d->id }}" data-namabarang="{{ $d->namaBarang }}" data-stock="{{ $d->stock }}" data-toggle="modal" data-target="#stockModal">
                                                    Tambah Stock
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('stock.nambah') }}" autocomplete="off" class="form-horizontal">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="stockModalLabel">Tambah Stock</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div hidden class="form-group {{ $errors->has('idBarang') ? ' has-danger' : '' }}">
                                                                <label for="idBarang" class="bmd-label-static">ID BARANG</label>
                                                                <input type="text" class="form-control idBarang" id="idBarang" name="idBarang">
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group {{ $errors->has('namaBarang') ? ' has-danger' : '' }} col-md-6">
                                                                    <label for="namaBarang" class="bmd-label-static">Kode Supplier</label>
                                                                    <input type="text" class="form-control namaBarang" id="namaBarang" name="namaBarang" readonly>
                                                                </div>

                                                                <div class="form-group {{ $errors->has('stock') ? ' has-danger' : '' }} col-md-6">
                                                                    <label for="stock" class="bmd-label-static">Sisa Stock</label>
                                                                    <input type="text" class="form-control stock" id="stock" name="stock" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-group {{ $errors->has('stockMasuk') ? ' has-danger' : '' }}">
                                                                <label for="stockMasuk" class="bmd-label-static">Jumlah Barang Masuk</label>
                                                                <input type="text" class="form-control {{ $errors->has('stock') ? ' is-invalid' : '' }}" id="stockMasuk" name="stockMasuk">
                                                            </div>

                                                            <div class="form-group {{ $errors->has('keterangan') ? ' has-danger' : '' }}">
                                                                <label for="keterangan" class="bmd-label-static">Keterangan</label>
                                                                <input type="text" class="form-control {{ $errors->has('keterangan') ? ' is-invalid' : '' }}" id="keterangan" name="keterangan">
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
    <script src="{{ asset('material/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('material/js/core/bootstrap-material-design.min.js') }}"></script>
    <script>
        $('#stockModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var idBarang = button.data('idbarang')
            var namaBarang = button.data('namabarang')
            var stock = button.data('stock')// Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body input.idBarang').val(idBarang)
            modal.find('.modal-body input.namaBarang').val(namaBarang)
            modal.find('.modal-body input.stock').val(stock)
        })
    </script>
@endsection

