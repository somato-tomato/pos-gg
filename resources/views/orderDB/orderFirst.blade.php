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
                            <h4 class="card-title ">(NOJS) TRANSAKSI BARU</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('noJS.invoice')  }}" enctype="multipart/form-data">
                                @csrf

                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-success">BUAT TRANSAKSI</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

