@extends('layouts.app', ['activePage' => 'rak', 'titlePage' => __('Rak Barang')])

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
                            <h4 class="card-title ">Rak Barang</h4>
                            <p class="card-category">Data Daftar Rak Barang</p>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rakModal">
                                Tambah Rak
                            </button>
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
                                                    <label for="namaRak" class="bmd-label-static">Nama Rak</label>
                                                    <input type="text" class="form-control {{ $errors->has('namaRak') ? ' is-invalid' : '' }}" id="namaRak" name="namaRak">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                @forelse($rak as $r)
                                                    <tr>
                                                        <td>{{$r->namaRak}}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td>GG</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rakBarangModal">
                                Tambah barang ke Rak
                            </button>
                            <div class="modal fade" id="rakBarangModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="post" action="{{ route('rak.storeRakBarang') }}" autocomplete="off" class="form-horizontal">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="stockModalLabel">Tambah Rak</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="pilihNamaRak">Pilih Posisi Rak</label>
                                                        <select id="pilihNamaRak" name="idRak" class="form-control">

                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="pilihNamaBarang">Nama Barang</label>
                                                        <select id="pilihNamaBarang" name="idBarang" class="form-control">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                @forelse($rak as $r)
                                                    <tr>
                                                        <td>{{$r->namaRak}}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td>GG</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table" id="barangTable">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Kode Barang
                                        </th>
                                        <th>
                                            Nama Barang
                                        </th>
                                        <th>
                                            Posisi Rak
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(function() {
            $('#barangTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('rak.getRak') }}',
                columns: [
                    { data: 'kodeBarang', name: 'barangs.kodeBarang' },
                    { data: 'namaBarang', name: 'barangs.namaBarang' },
                    { data: 'namaRak', name: 'raks.namaRak' }
                ]
            });
        });
        $('#pilihNamaRak').select2({
            dropdownParent: $('#rakBarangModal'),
            placeholder: 'Masukan Nama Rak',
            theme: 'material',
            ajax: {
                url: '{{ route('rak.getList') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.namaRak,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        $('#pilihNamaBarang').select2({
            dropdownParent: $('#rakBarangModal'),
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

