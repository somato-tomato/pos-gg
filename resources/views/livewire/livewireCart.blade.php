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

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-4">
                                <input class="form-control">
                                <div class="row">
                                    @foreach($products as $b)
                                        <div class="card" style="width: 10rem; margin-right: 10px">
                                            <form action="{{url('/transaksii/addproduct', $b->id)}}" method="POST">
                                                @csrf
                                                @if($b->stock == 0)
                                                    <img class="card-img-top gambar" src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80" alt="Card image cap">
                                                    <button class="btn btn-primary btn-sm cart-btn disabled"><i
                                                            class="fas fa-cart-plus"></i></button>

                                                @else
                                                    <img class="card-img-top gambar" src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80" alt="Card image cap"style="cursor: pointer"
                                                         onclick="this.closest('form').submit();return false;">
                                                    <button type="submit" class="btn btn-primary btn-sm cart-btn"><i
                                                            class="fas fa-cart-plus"></i></button>
                                                @endif
                                                <div class="card-body">
                                                    <label class="card-text text-center font-weight-bold"
                                                           style="text-transform: capitalize;">
                                                        {{ Str::words($b->namaBarang,4) }} ({{$b->stock}}) </label>
                                                    <p class="card-text text-center">Rp. {{ number_format($b->hargaJualSatuan,2,',','.') }}
                                                    </p>
                                                </div>
                                        </div>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

