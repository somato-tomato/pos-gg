@extends('layouts.app', ['activePage' => 'barangSup', 'titlePage' => __('Supplier Barang')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" action="{{ route('bSupplier.store') }}" autocomplete="off" class="form-horizontal">
                        @csrf

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Tambah Supplier Barang') }}</h4>
                                <p class="card-category">{{ __('Data Supplier Barang') }}</p>
                            </div>

                            <div class="card-body">
                                <div class="text-right">
                                    <a href="{{ route('bSupplier.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="id_label_single"> Nama Supplier
                                            <select id="namaSupplier" class="form-control namaSupplier" name="idSupplier"></select>
                                        </label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="id_label_single"> Nama Barang
                                            <select id="namaBarang" class="form-control namaBarang" name="idBarang"></select>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('hargaBeli') ? ' has-danger' : '' }}">
                                    <label for="hargaBeli" class="bmd-label-static">Harga Beli Barang</label>
                                    <input type="number" class="form-control {{ $errors->has('hargaBeli') ? ' is-invalid' : '' }}" id="hargaBeli" name="hargaBeli">
                                    <small id="KSHelp" class="form-text text-muted">Diisi dengan Kode Barang</small>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('material/js/core/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('.namaSupplier').select2({
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
        $('.namaBarang').select2({
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
