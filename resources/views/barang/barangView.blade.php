@extends('layouts.app', ['activePage' => 'barang', 'titlePage' => __('Barang Masuk')])

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-md-10">
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
                <div class="col-md-10">
                    <div class="card card-nav-tabs card-plain">
                        <div class="card-header card-header-danger">
                            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#barang" data-toggle="tab">Barang / Produk</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#disc" data-toggle="tab"><i>Discount </i> - Kategori - Rak</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#supplier" data-toggle="tab">Supplier</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="tab-content">
                                <div class="tab-pane active" id="barang">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-right">
                                                        <a href="{{ route('barang.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group {{ $errors->has('kodeBarang') ? ' has-danger' : '' }} col-md-6">
                                                            <label for="kodeBarang" class="bmd-label-floating" style="color: black">Kode Barang</label>
                                                            <input type="text" class="form-control {{ $errors->has('kodeBarang') ? ' is-invalid' : '' }}" id="kodeBarang" name="kodeBarang" value="{{ $data->kodeBarang }}" readonly>
                                                        </div>

                                                        <div class="form-group {{ $errors->has('namaBarang') ? ' has-danger' : '' }} col-md-6">
                                                            <label for="namaBarang" class="bmd-label-floating" style="color: black">Nama Barang</label>
                                                            <input type="text" class="form-control {{ $errors->has('namaBarang') ? ' is-invalid' : '' }}" id="namaBarang" name="namaBarang" value="{{ $data->namaBarang }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group {{ $errors->has('hargaJualSatuan') ? ' has-danger' : '' }} col-md-4">
                                                            <label for="hargaJualSatuan" class="bmd-label-floating" style="color: black">Harga Jual Satuan</label>
                                                            <input type="number" class="form-control {{ $errors->has('hargaJualSatuan') ? ' is-invalid' : '' }}" id="hargaJualSatuan" name="hargaJualSatuan" value="{{ $data->hargaJualSatuan }}" readonly>
                                                        </div>

                                                        <div class="form-group {{ $errors->has('satuan') ? ' has-danger' : '' }} col-md-2">
                                                            <label for="satuan" class="bmd-label-floating" style="color: black">Satuan</label>
                                                            <input type="text" class="form-control {{ $errors->has('satuan') ? ' is-invalid' : '' }}" id="satuan" name="satuan" value="{{ $data->satuan }}" readonly>
                                                        </div>

                                                        <div class="form-group {{ $errors->has('stock') ? ' has-danger' : '' }} col-md-2">
                                                            <label for="stock" class="bmd-label-floating" style="color: black">Stock</label>
                                                            <input type="number" class="form-control {{ $errors->has('stock') ? ' is-invalid' : '' }}" id="stock" name="stock" value="{{ $data->stock }}" readonly>
                                                        </div>

                                                        <div class="form-group {{ $errors->has('minStock') ? ' has-danger' : '' }} col-md-2">
                                                            <label for="minStock" class="bmd-label-floating" style="color: black">Minimal Stock</label>
                                                            <input type="number" class="form-control {{ $errors->has('minStock') ? ' is-invalid' : '' }}" id="minStock" name="minStock" value="{{ $data->minStock }}" readonly>
                                                        </div>

                                                        <div class="form-group {{ $errors->has('jmlPerdus') ? ' has-danger' : '' }} col-md-2">
                                                            <label for="jmlPerdus" class="bmd-label-floating" style="color: black">Jumlah Perdus</label>
                                                            <input type="number" class="form-control {{ $errors->has('jmlPerdus') ? ' is-invalid' : '' }}" id="jmlPerdus" name="jmlPerdus" value="{{ $data->jmlPerdus }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer ml-auto mr-auto">
                                                    <a href="{{ route('barang.edit', $data->id) }}" type="submit" class="btn btn-primary">{{ __('Update') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="avatar-upload">
                                                <div class="avatar-preview">
                                                    <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="disc">
                                    <div class="row">
                                        <div class="col-md-8">
{{--                                            Discount --}}
                                            <div class="card">
                                                <form method="post" action="{{ route('rule.add', $data->id) }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group {{ $errors->has('kodeBarang') ? ' has-danger' : '' }} col-md-2">
                                                                <label for="kodeBarang" class="bmd-label-floating" style="color: black">Kode Barang</label>
                                                                <input type="text" class="form-control {{ $errors->has('kodeBarang') ? ' is-invalid' : '' }}" id="kodeBarang" name="kodeBarang" value="{{ $data->kodeBarang }}" readonly>
                                                            </div>

                                                            <div class="form-group {{ $errors->has('kodeBarang') ? ' has-danger' : '' }} col-md-2" hidden>
                                                                <label for="idBarang" class="bmd-label-floating">id Barang</label>
                                                                <input type="text" class="form-control {{ $errors->has('idBarang') ? ' is-invalid' : '' }}" id="idBarang" name="idBarang" value="{{ $data->id }}" readonly>
                                                            </div>

                                                            <div class="form-group {{ $errors->has('jumlahBeli') ? ' has-danger' : '' }} col-md-4">
                                                                <label for="jumlahBeli" class="bmd-label-floating">Jumlah Beli</label>
                                                                <input type="text" class="form-control {{ $errors->has('jumlahBeli') ? ' is-invalid' : '' }}" id="jumlahBeli" name="jumlahBeli">
                                                            </div>

                                                            <div class="form-group {{ $errors->has('discount') ? ' has-danger' : '' }} col-md-4">
                                                                <label for="discount" class="bmd-label-floating">Discount</label>
                                                                <input type="text" class="form-control {{ $errors->has('discount') ? ' is-invalid' : '' }}" id="discount" name="discount">
                                                            </div>

                                                            <div class="col-md-2">
                                                                <button type="submit" class="btn btn-primary btn-sm">{{ __('Tambah') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
{{--                                            Kategori --}}
                                            <div class="card">
                                                @if($kategori == null && $rak == null)
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group {{ $errors->has('kategori') ? ' has-danger' : '' }} col-md-5">
                                                                <label for="kategori" class="bmd-label-floating">Kategori</label>
                                                                <input type="text" class="form-control {{ $errors->has('kategori') ? ' is-invalid' : '' }}" id="kategori" name="kategori" value="Silahkan pilih Kategori" disabled>
                                                            </div>

                                                            <div class="form-group {{ $errors->has('rak') ? ' has-danger' : '' }} col-md-5">
                                                                <label for="rak" class="bmd-label-floating">Lokasi Rak</label>
                                                                <input type="text" class="form-control {{ $errors->has('rak') ? ' is-invalid' : '' }}" id="rak" name="rak" value="Silahkan pilih Lokasi Rak" disabled>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rakBarangModal">
                                                                    Tambah
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($kategori == true && $rak == null)
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group {{ $errors->has('kategori') ? ' has-danger' : '' }} col-md-5">
                                                                <label for="kategori" class="bmd-label-floating">Kategori</label>
                                                                <input type="text" class="form-control {{ $errors->has('kategori') ? ' is-invalid' : '' }}" id="kategori" name="kategori" value="{{ $kategori->namaKategori }}" disabled>
                                                            </div>

                                                            <div class="form-group {{ $errors->has('rak') ? ' has-danger' : '' }} col-md-5">
                                                                <label for="rak" class="bmd-label-floating">Lokasi Rak</label>
                                                                <input type="text" class="form-control {{ $errors->has('rak') ? ' is-invalid' : '' }}" id="rak" name="rak" value="Silahkan pilih Lokasi Rak" disabled>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rakBarangModal">
                                                                    Tambah
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($kategori == null && $rak == true)
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group {{ $errors->has('kategori') ? ' has-danger' : '' }} col-md-5">
                                                                <label for="kategori" class="bmd-label-floating">Kategori</label>
                                                                <input type="text" class="form-control {{ $errors->has('kategori') ? ' is-invalid' : '' }}" id="kategori" name="kategori" value="Silahkan pilih Kategori" disabled>
                                                            </div>

                                                            <div class="form-group {{ $errors->has('rak') ? ' has-danger' : '' }} col-md-5">
                                                                <label for="rak" class="bmd-label-floating">Lokasi Rak</label>
                                                                <input type="text" class="form-control {{ $errors->has('rak') ? ' is-invalid' : '' }}" id="rak" name="rak" value="{{ $rak->namaRak }}" disabled>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rakBarangModal">
                                                                    Tambah
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group {{ $errors->has('kategori') ? ' has-danger' : '' }} col-md-5">
                                                                <label for="kategori" class="bmd-label-floating">Kategori</label>
                                                                <input type="text" class="form-control {{ $errors->has('kategori') ? ' is-invalid' : '' }}" id="kategori" name="kategori" value="{{ $kategori->namaKategori }}" disabled>
                                                            </div>

                                                            <div class="form-group {{ $errors->has('rak') ? ' has-danger' : '' }} col-md-5">
                                                                <label for="rak" class="bmd-label-floating">Lokasi Rak</label>
                                                                <input type="text" class="form-control {{ $errors->has('rak') ? ' is-invalid' : '' }}" id="rak" name="rak" value="{{ $rak->namaRak }}" disabled>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rakBarangModal">
                                                                    Tambah
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="modal fade" id="rakBarangModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="post" action="{{ route('rule.addKategorak') }}" autocomplete="off" class="form-horizontal">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="stockModalLabel">Tambah Rak</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-row">
                                                                            <div class="form-group {{ $errors->has('kodeBarang') ? ' has-danger' : '' }} col-md-2" hidden>
                                                                                <label for="idBarang" class="bmd-label-floating">id Barang</label>
                                                                                <input type="text" class="form-control {{ $errors->has('idBarang') ? ' is-invalid' : '' }}" id="idBarang" name="idBarang" value="{{ $data->id }}" readonly>
                                                                            </div>

                                                                            <div class="form-group col-md-6">
                                                                                <label for="pilihNamaKategori">Nama Kategori</label>
                                                                                <select id="pilihNamaKategori" name="idKategori" class="form-control">

                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="pilihNamaRak">Pilih Posisi Rak</label>
                                                                                <select id="pilihNamaRak" name="idRak" class="form-control">

                                                                                </select>
                                                                            </div>
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
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th>Jumlah Beli</th>
                                                                <th>Diskon</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse($discount as $d)
                                                                <tr>
                                                                    <td>{{ $d->jumlahBeli }} {{ $data->satuan }}</td>
                                                                    <td>{{ $d->discount }} %</td>
                                                                    <td class="td-actions text-right">
                                                                        @if($d->status == 0)
                                                                            <form action="{{ route('rule.nonAktif', $d->id) }}" method="post">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <button onclick='return confirm("nonAktifkan Discount ?")' type="submit" rel="tooltip" class="btn btn-success">
                                                                                    <i class="material-icons">check_box</i>
                                                                                </button>
                                                                            </form>
                                                                        @else
                                                                            <form action="{{ route('rule.aktif', $d->id) }}" method="post">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <button onclick='return confirm("Aktifkan Discount ?")' type="submit" rel="tooltip" class="btn btn-danger">
                                                                                    <i class="material-icons">remove_circle</i>
                                                                                </button>
                                                                            </form>
                                                                        @endif
                                                                        <form action="{{ route('rule.delete', $d->id) }}" method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button onclick='return confirm("Hapus Discount ?")' type="submit" rel="tooltip" class="btn btn-warning">
                                                                                <i class="material-icons">remove</i>
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    Belum ada Diskon
                                                                </tr>
                                                            @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="supplier">
                                    <div class="row  justify-content-center">
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form action="{{ route('bSupplier.store') }}" method="post">
                                                                @csrf

                                                                <div hidden class="form-group {{ $errors->has('idBarang') ? ' has-danger' : '' }}">
                                                                    <label for="idBarang" class="bmd-label-floating">Harga Beli Barang</label>
                                                                    <input type="text" class="form-control {{ $errors->has('idBarang') ? ' is-invalid' : '' }}" id="idBarang" name="idBarang" value="{{ $data->id }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_label_single"> Nama Supplier
                                                                        <select id="namaSupplier" class="form-control namaSupplier" name="idSupplier"></select>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group {{ $errors->has('hargaBeli') ? ' has-danger' : '' }}">
                                                                    <label for="hargaBeli" class="bmd-label-floating">Harga Beli Barang</label>
                                                                    <input type="number" class="form-control {{ $errors->has('hargaBeli') ? ' is-invalid' : '' }}" id="hargaBeli" name="hargaBeli">
                                                                </div>
                                                                <div class="text-center">
                                                                    <button type="submit" class="btn btn-primary">{{ __('Tambah') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Supplier</th>
                                                                    <th>Harga dari Supplier</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @forelse($supplier as $s)
                                                                    <tr>
                                                                        <td>{{ $s->namaSupplier }}</td>
                                                                        <td>{{ $s->hargaBeli }}</td>
                                                                        <td class="td-actions text-right">
                                                                            <form action="{{ route('rule.delete', $d->id) }}" method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button onclick='return confirm("Hapus Discount ?")' type="submit" rel="tooltip" class="btn btn-warning">
                                                                                    <i class="material-icons">remove</i>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        Belum ada Diskon
                                                                    </tr>
                                                                @endforelse
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        $('#pilihNamaKategori').select2({
            dropdownParent: $('#rakBarangModal'),
            placeholder: 'Masukan Nama Kategori',
            theme: 'material',
            ajax: {
                url: '{{ route('kategori.getList') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.namaKategori,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
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
    </script>
@endsection
