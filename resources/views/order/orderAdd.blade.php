@extends('layouts.app', ['activePage' => 'order', 'titlePage' => __('Transaksi')])

@section('content')
    <div class="content" id="dw">
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
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Barang Masuk</h4>
                            <p class="card-category">Data Barang Masuk</p>
                        </div>
                        <div class="card-body">
                            <form action="#" @submit.prevent="addToCart" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">Produk</label>
                                    <select name="barang_id" id="barang_id" class="form-control" required width="100%">
                                        <option value="">Pilih</option>
                                        @foreach ( $barang as $b )
                                            <option value="{{ $b->id }}">{{ $b->namaBarang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="qty">Qty</label>
                                    <input type="text" name="qty" id="qty" value="1" min="1" class="form-control">
                                </div>
                                <button class="btn btn-primary btn-sm" :disabled="submitCart">
                                    <i class="fa fa-shopping-cart"></i> @{{ submitCart ? 'Loading...':'Ke Keranjang' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Barang Masuk</h4>
                            <p class="card-category">Data Barang Masuk</p>
                        </div>
                        <div class="card-body">
                            <div v-if="barang.namaBarang">
                                <table class="table table-stripped">
                                    <tr>
                                        <th>Kode</th>
                                        <td>:</td>
                                        <td>@{{ barang.kodeBarang }}</td>
                                    </tr>
                                    <tr>
                                        <th width="3%">Produk</th>
                                        <td width="2%">:</td>
                                        <td>@{{ barang.namaBarang }}</td>
                                    </tr>
                                    <tr>
                                        <th>Harga</th>
                                        <td>:</td>
                                        <td>@{{ barang.hargaJualSatuan | currency }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Barang Masuk</h4>
                            <p class="card-category">Data Barang Masuk</p>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- MENGGUNAKAN LOOPING VUEJS -->
                                <tr v-for="(row, index) in shoppingCart">
                                    <td>@{{ row.namaBarang }} (@{{ row.kodeBarang }})</td>
                                    <td>@{{ row.hargaJualSatuan | currency }}</td>
                                    <td>@{{ row.qty }}</td>
                                    <td>
                                        <!-- EVENT ONCLICK UNTUK MENGHAPUS CART -->
                                        <button
                                            @click.prevent="removeCart(index)"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('material/js/core/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
    <script src="{{ asset('js/transaksi.js') }}"></script>
@endsection

