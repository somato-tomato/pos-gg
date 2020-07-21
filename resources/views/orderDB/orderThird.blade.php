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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <p>TOKO SERBAGUNA</p>
                                <p>JL. BUMI SARI INDAH C.39, MANGGHANG, BALEENDAH</p>
                            </div>
                            <hr>
                            <p>{{ $order->updated_at }}</p>
                            <hr>
                            <div>
                                <table class="table table-borderless">
                                    <tbody>
                                    @foreach($list as $l)
                                        <tr>
                                            <td>{{ $l->namaBarang }}</td>
                                            <td>{{ $l->qty }}</td>
                                            <td>{{ $l->hargaJualSatuan }}</td>
                                            <td>{{ $l->hargaBarang }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <p>TOTAL : {{ $order->total }}</p>
                                        <p>TUNAI : {{ $order->bayar }}</p>
                                        <p>KEMBALI : {{ $kembali }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-6">
                            <form method="post" action="{{ route('noJS.invoice')  }}" enctype="multipart/form-data">
                                @csrf
                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-success">TRANSAKSI BARU</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('noJS.first') }}" type="button" class="btn btn-lg btn-info">HALAMAN AWAL</a>
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

