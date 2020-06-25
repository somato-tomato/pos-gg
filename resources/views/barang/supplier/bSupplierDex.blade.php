@extends('layouts.app', ['activePage' => 'barangSup', 'titlePage' => __('Supplier Barang')])

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
                            <h4 class="card-title ">Supplier Barang</h4>
                            <p class="card-category">Data Supplier Barang</p>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('bSupplier.create') }}" class="btn btn-primary btn-sm" type="button">Tambah Supplier Barang</a>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Nama Supplier
                                        </th>
                                        <th>
                                            Nama Barang
                                        </th>
                                        <th>
                                            Harga dari Supplier
                                        </th>
                                        <th class="text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td> {{$d->namaSupplier}} </td>
                                            <td> {{$d->namaBarang}} </td>
                                            <td> {{$d->hargaBeli}} </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm"
                                                        data-id="{{ $d->id }}"
                                                        data-namabarang="{{ $d->namaBarang }}"
                                                        data-namasupplier="{{ $d->namaSupplier }}"
                                                        data-hargabeli="{{ $d->hargaBeli }}"
                                                        data-toggle="modal" data-target="#stockModal">
                                                    Perbarui
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('bSupplier.update') }}" autocomplete="off" class="form-horizontal">
                                                        @csrf
{{--                                                        @method('PUT')--}}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="stockModalLabel">Perbaharui Supplier Barang</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group {{ $errors->has('id') ? ' has-danger' : '' }}">
                                                                <label for="id" class="bmd-label-static">ID BARANG</label>
                                                                <input type="text" class="form-control id" id="id" name="id">
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="id_label_single"> Nama Supplier
                                                                        <select id="namaSupplier" class="form-control namaSupplier" name="idSupplier"></select>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="id_label_single"> Nama Barang
                                                                        <select id="namaBarang" class="form-control namaBarang" name="idBarang"></select>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group {{ $errors->has('hargaBeli') ? ' has-danger' : '' }}">
                                                                <label for="hargaBeli" class="bmd-label-static">Harga dari Supplier</label>
                                                                <input type="number" class="form-control hargaBeli" id="hargaBeli" name="hargaBeli">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ asset('material/js/core/bootstrap-material-design.min.js') }}"></script>
    <script>
        $('#stockModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var hargaBeli = button.data('hargabeli')
            var modal = $(this)
            modal.find('.modal-body input.id').val(id)
            modal.find('.modal-body input.hargaBeli').val(hargaBeli)
        });
        $('#namaSupplier').select2({
            dropdownParent: $('#stockModal'),
            placeholder: 'Masukan Nama Supplier',
            theme: 'material',
            ajax: {
                url: '{{ route('bSupplier.loadSupplier') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.namaSupplier,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
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

