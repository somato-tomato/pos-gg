@extends('layouts.app', ['activePage' => 'kategori', 'titlePage' => __('Kategori')])

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
                            <h4 class="card-title ">Kategori</h4>
                            <p class="card-category">Data Daftar Kategori</p>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#kategoriModal">
                                Tambah Kategori
                            </button>
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

                            <div class="table-responsive">
                                <table class="table" id="barangTable">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Nama Kategori
                                        </th>
{{--                                        <th>--}}
{{--                                            Jumlah Barang dalam Kategori--}}
{{--                                        </th>--}}
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
            $('#barangTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('barang.getBarang') }}',
                columns: [
                    { data: 'namaKategori', name: 'namaKategori' }
                ]
            });
        });
    </script>
@endsection

