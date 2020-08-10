@extends('layouts.app', ['activePage' => 'barang', 'titlePage' => __('Barang Masuk')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form method="post" action="{{ route('barang.save') }}" autocomplete="off" class="form-horizontal">
                        @csrf

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Tambah Barang') }}</h4>
                                <p class="card-category">{{ __('Data Barang') }}</p>
                            </div>

                            <div class="card-body">
                                <div class="text-right">
                                    <a href="{{ route('barang.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-row">
                                            <div class="form-group {{ $errors->has('kodeBarang') ? ' has-danger' : '' }} col-md-4">
                                                <label for="kodeBarang" class="bmd-label-static">Kode Barang</label>
                                                <input type="text" class="form-control {{ $errors->has('kodeBarang') ? ' is-invalid' : '' }}" id="kodeBarang" name="kodeBarang">
                                                <small id="KSHelp" class="form-text text-muted">Diisi dengan Kode Barang</small>
                                            </div>

                                            <div class="form-group {{ $errors->has('namaBarang') ? ' has-danger' : '' }} col-md-4">
                                                <label for="namaBarang" class="bmd-label-static">Nama Barang</label>
                                                <input type="text" class="form-control {{ $errors->has('namaBarang') ? ' is-invalid' : '' }}" id="namaBarang" name="namaBarang">
                                                <small id="KSHelp" class="form-text text-muted">Diisi dengan Nama Barang</small>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <select id="kategori" name="idKategori" class="form-control">
                                                    @foreach( $kategori as $value => $key)
                                                        <option value="{{ $value }}">{{ $key }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="form-group {{ $errors->has('hargaJualSatuan') ? ' has-danger' : '' }} col-md-4">
                                                <label for="hargaJualSatuan" class="bmd-label-static">Harga Jual Satuan</label>
                                                <input type="number" class="form-control {{ $errors->has('hargaJualSatuan') ? ' is-invalid' : '' }}" id="hargaJualSatuan" name="hargaJualSatuan">
                                                <small id="KSHelp" class="form-text text-muted">Harga Satuan Barang</small>
                                            </div>

                                            <div class="form-group {{ $errors->has('satuan') ? ' has-danger' : '' }} col-md-2">
                                                <label for="satuan" class="bmd-label-static">Satuan</label>
                                                <input type="text" class="form-control {{ $errors->has('satuan') ? ' is-invalid' : '' }}" id="satuan" name="satuan">
                                                <small id="KSHelp" class="form-text text-muted">Cth : PCS, BJ, BUAH</small>
                                            </div>

                                            <div class="form-group {{ $errors->has('stock') ? ' has-danger' : '' }} col-md-2">
                                                <label for="stock" class="bmd-label-static">Stock Awal</label>
                                                <input type="number" class="form-control {{ $errors->has('stock') ? ' is-invalid' : '' }}" id="stock" name="stock">
                                                <small id="KSHelp" class="form-text text-muted">Stok awal dlm satuan</small>
                                            </div>

                                            <div class="form-group {{ $errors->has('minStock') ? ' has-danger' : '' }} col-md-2">
                                                <label for="minStock" class="bmd-label-static">Minimal Stock</label>
                                                <input type="number" class="form-control {{ $errors->has('minStock') ? ' is-invalid' : '' }}" id="minStock" name="minStock">
                                                <small id="KSHelp" class="form-text text-muted">Minimal stok barang</small>
                                            </div>

                                            <div class="form-group {{ $errors->has('jmlPerdus') ? ' has-danger' : '' }} col-md-2">
                                                <label for="jmlPerdus" class="bmd-label-static">Jumlah Perdus</label>
                                                <input type="number" class="form-control {{ $errors->has('jmlPerdus') ? ' is-invalid' : '' }}" id="jmlPerdus" name="jmlPerdus">
                                                <small id="KSHelp" class="form-text text-muted">Jmlh per Satu Dus</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="panel">
                                            <div class="button_outer">
                                                <div class="btn_upload">
                                                    <input type="file" id="upload_file" name="">
                                                    Upload Image
                                                </div>
                                                <div class="processing_bar"></div>
                                                <div class="success_box"></div>
                                            </div>
                                        </div>
                                        <div class="error_msg"></div>
                                        <div class="uploaded_file_view" id="uploaded_view">
                                            <span class="file_remove">X</span>
                                        </div>
                                    </div>
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
    <script src="{{ asset('js/fileupload.js') }}"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>--}}
{{--    <script type="text/javascript">--}}
{{--        $('.namaSupplier').select2({--}}
{{--            placeholder: 'Masukan Nama Supplier Barang',--}}
{{--            theme: 'material',--}}
{{--            ajax: {--}}
{{--                url: '{{ route('barang.loadSupplier') }}',--}}
{{--                dataType: 'json',--}}
{{--                delay: 250,--}}
{{--                processResults: function (data) {--}}
{{--                    return {--}}
{{--                        results:  $.map(data, function (item) {--}}
{{--                            return {--}}
{{--                                text: item.namaSupplier,--}}
{{--                                id: item.id--}}
{{--                            }--}}
{{--                        })--}}
{{--                    };--}}
{{--                },--}}
{{--                cache: true--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endsection
