@extends('layouts.app', ['activePage' => 'nojs', 'titlePage' => __('Transaksi')])

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
                            <form action="{{ route('noJS.cart') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" name="idOrder" value="{{ $inv->id }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" value="{{ $inv->invoice }}">
                                </div>
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
                                    <input type="number" name="qty" id="qty" min="1" class="form-control">
                                </div>
                                <button class="btn btn-primary btn-sm" type="submit">MASUK</button>
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
                    <form action="{{ route('noJS.order', $inv->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                    @forelse( $cart as $c )
                                        <tr>
                                            <td>{{ $c->namaBarang }}</td>
                                            <td>{{ $c->hargaBarang }}</td>
                                            <td>{{ $c->qty }}</td>
                                            <td>
                                                {{--                                            <!-- EVENT ONCLICK UNTUK MENGHAPUS CART -->--}}
                                                {{--                                            <button--}}
                                                {{--                                                @click.prevent="removeCart(index)"--}}
                                                {{--                                                class="btn btn-danger btn-sm">--}}
                                                {{--                                                <i class="fa fa-trash"></i>--}}
                                                {{--                                            </button>--}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>Silahkan Belanja</td>
                                        </tr>
                                    @endforelse
                                    @if ( $total === 0)
                                        <tr>
                                            <td></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td style="text-align: right" colspan="3">Total</td>
                                            <td>{{ $total }}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" name="bayar" placeholder="BAYAR!">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-sm"> Bayar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('material/js/core/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
    <script src="{{ asset('js/transaksi.js') }}"></script>
@endsection

