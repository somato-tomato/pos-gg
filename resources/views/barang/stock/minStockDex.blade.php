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
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#stockModal">
                                Tambah Stock
                            </button>
                            <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
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

                                                <div class="form-group">
                                                    <label for="id_label_single"> Nama Barang
                                                        <select id="namaBarang" class="form-control namaBarang" name="idBarang"></select>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <label for="id_label_single"> Nama Barang
                                                        <select id="namaBarang" class="form-control namaBarang" name="idBarang"></select>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputState">State</label>
                                                    <select id="inputState" class="form-control">
                                                        <option selected>Choose...</option>
                                                        <option>...</option>
                                                    </select>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputCity">City</label>
                                                        <input type="text" class="form-control" id="inputCity">
                                                    </div>

                                                    <div class="form-group col-md-2 ml-auto">
                                                        <label for="inputZip">Zip</label>
                                                        <input type="text" class="form-control" id="inputZip">
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
                                            Stock
                                        </th>
                                        <th>
                                            Minimal Stok
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td> {{$d->kodeBarang}} </td>
                                            <td> {{$d->namaBarang}} </td>
                                            <td> {{$d->stock}} </td>
                                            <td> {{$d->minStock}} </td>
                                        </tr>
                                        <!-- Modal -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('#namaBarang').select2({
            dropdownParent: $('#stockModal'),
            placeholder: 'Masukan Nama Barang',
            theme: 'material',
            ajax: {
                url: '{{ route('bSupplier.loadBarang') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.namaBarang,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endsection

