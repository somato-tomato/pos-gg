@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-8">
                  <div class="card card-chart">
                      <div class="card-header card-header-success"></div>
                      <div class="card-body">

                          <div class="row text-center">
                              @foreach($products as $b)
                                  <div class="card" style="width: 15rem; margin-left: 25px; margin-right: 10px">
                                      <form action="{{url('/transaksii/addproduct', $b->id)}}" method="POST">
                                          @csrf
                                          @if($b->stock == 0)
                                              <img class="card-img-top gambar" src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80" alt="Card image cap">
                                              <button class="btn btn-primary btn-sm cart-btn disabled"><i class="fas fa-cart-plus"></i></button>
                                          @else
                                              <img class="card-img-top gambar" src="https://images.unsplash.com/photo-1517303650219-83c8b1788c4c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bd4c162d27ea317ff8c67255e955e3c8&auto=format&fit=crop&w=2691&q=80" alt="Card image cap"style="cursor: pointer" onclick="this.closest('form').submit();return false;">
                                              <button type="submit" class="btn btn-primary btn-sm cart-btn"><i class="fas fa-cart-plus"></i></button>
                                          @endif
                                          <div class="card-body">
                                              <label class="card-text text-center font-weight-bold" style="text-transform: capitalize;">
                                                  {{ Str::words($b->namaBarang,4) }} ({{$b->stock}}) </label>
                                              <p class="card-text text-center">Rp. {{ number_format($b->hargaJualSatuan,2,',','.') }}</p>
                                          </div>
                                      </form>
                                  </div>
                              @endforeach
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="card card-chart">
                      <div class="card-header card-header-warning"></div>
                      <div class="card-body">
                          <h4 class="card-title">Cart</h4>
                          <p class="card-category"></p>
                      </div>
                      <div class="card-body">
                          <div style="overflow-y:auto;min-height:53vh;max-height:53vh" class="mb-3">
                              <table class="table table-sm">
                                  <thead>
                                  <tr>
                                      <th width="10%">No</th>
                                      <th width="30%">Nama Product</th>
                                      <th width="30%">Qty</th>
                                      <th width="30%" class="text-right">Sub Total</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @php
                                      $no=1
                                  @endphp
                                  @forelse($cart_data as $index=>$item)
                                      <tr>
                                          <td>
                                              <form action="{{url('/transaksii/removeproduct',$item['rowId'])}}" method="POST">
                                                  @csrf
                                                  {{$no++}} <br><a onclick="this.closest('form').submit();return false;"><i class="fas fa-trash" style="color: rgb(134, 134, 134)"></i></a>
                                              </form>
                                          </td>
                                          <td>{{ Str::words($item['name'],3) }} <br>Rp.
                                              {{ number_format($item['pricesingle'],2,',','.') }}
                                          </td>
                                          <td class="font-weight-bold">
                                          <!--   <form action="{{url('/transaksii/decreasecart', $item['rowId'])}}"
                                            method="POST" style='display:inline;'>
                                            @csrf
                                              <button class="btn btn-sm btn-info"
                                                  style="display: inline;padding:0.4rem 0.6rem!important"><i
                                                      class="fas fa-minus"></i></button>
                                          </form> -->
                                              <a style="display: inline">{{$item['qty']}}</a>
                                              <form action="{{url('/transaksii/increasecart', $item['rowId'])}}"
                                                    method="POST" style='display:inline;'>

                                                  <input type="text" name="qy"class="form-control" placeholder="Qty" >
                                                  @csrf
                                                  <button class="btn btn-sm btn-primary"
                                                          style="display: inline;padding:0.4rem 0.6rem!important"><i
                                                          class="fas fa-plus"></i></button>
                                              </form>
                                          </td>
                                          <td class="text-right">
                                              <form action="{{url('/transaksii/increasecart1', $item['rowId'])}}" method="POST" style='display:inline;'>
                                                  @csrf
                                                  <input type="text" value="{{$item['price']}}" id="price"name="price1">
                                                  <button class="btn btn-sm btn-primary" style="display: inline;padding:0.4rem 0.6rem!important"><i class="fas fa-plus"></i></button>
                                              </form>
                                          </td>
                                      </tr>
                                  @empty
                                      <tr>
                                          <td colspan="4" class="text-center">Empty Cart</td>
                                      </tr>
                                  @endforelse
                                  </tbody>
                              </table>
                          </div>
                          <table class="table table-sm table-borderless">
                              <tr>
                                  <th width="60%">Sub Total</th>
                                  <th width="40%" class="text-right">
                                      <input type="text" id="sub">Rp. {{ number_format($data_total['sub_total'],2,',','.') }}
                                  </th>
                              </tr>
                              <tr>
                                  <th>
                                      <form action="{{ url('/transaksii') }}" method="get">
                                          PPN 10%
                                          <input type="checkbox" {{ $data_total['tax'] > 0 ? "checked" : ""}} name="tax"
                                                 value="true" onclick="this.form.submit()">
                                      </form>
                                  </th>
                                  <th class="text-right">Rp.{{ number_format($data_total['tax'],2,',','.') }}</th>
                              </tr>
                              <tr>
                                  <th>Total</th>
                                  <th class="text-right font-weight-bold">Rp.
                                      {{ number_format($data_total['total'],2,',','.') }}</th>
                              </tr>
                          </table>
                          <div class="row">
                              <div class="col-sm-4">
                                  <form action="{{ url('/transaksii/clear') }}" method="POST">
                                      @csrf
                                      <button class="btn btn-info btn-lg btn-block" style="padding:1rem!important" onclick="return confirm('Apakah anda yakin ingin meng-clear cart ?');" type="submit">Clear</button>
                                  </form>
                              </div>
                              <script type="text/javascript">
                                  function ot(){
                                      var harga = document.getElementById('price').value;
                                      var sub = document.getElementById('sub').value;
                                  }
                              </script>
                          </div>
                          <div class="col-sm-4">
                              <button class="btn btn-success btn-lg btn-block" style="padding:1rem!important" data-toggle="modal" data-target="#fullHeightModalRight">Pay</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade right" id="fullHeightModalRight" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-full-height modal-right" role="document"><div class="modal-content">
              <div class="modal-header indigo">
                  <h6 class="modal-title w-100 text-light" id="myModalLabel">Billing Information</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                  <table class="table table-sm table-borderless">
                        <tr>
                            <th width="60%">Sub Total</th>
                            <th width="40%" class="text-right">
                            Rp.
                                {{ number_format($data_total['sub_total'],2,',','.') }} </th>

                        </tr>
                        @if($data_total['tax'] > 0)
                        <tr>
                            <th>PPN 10%</th>
                            <th class="text-right">Rp.
                                {{ number_format($data_total['tax'],2,',','.') }}</th>
                        </tr>
                        @endif
                    </table>
                  <form action="{{ url('/transaksii/bayar') }}" method="POST">
                      @csrf
                      <div class="form-group">
                          <h1 class="font-weight-bold mb-5">Rp. {{ number_format($data_total['total'],2,',','.') }}</h1>
                      </div>
                      <div class="modal-footer justify-content-center">
                          <input id="totalHidden" type="hidden" name="totalHidden" value="{{$data_total['total']}}" />
                          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" id="saveButton"  onClick="openWindowReload(this)">Save transcation</button>
                      </div>
                  </form>
                  <div class="form-group">
                      <!-- <input id="oke" class="form-control" type="number" name="bayar" autofocus  /> -->
                      <h3 class="font-weight-bold">Bayar:</h3>
                      <input  class="font-weight-bold mb-5"  type="number" name="pembayaran" id="pembayaran" onkeyup ="jumlah()" />
                      <h3 class="font-weight-bold text-primary">Kembalian:</h3>
                      <input class="font-weight-bold text-primary" id="kembalian" name="kembalian" type="number">
                  </div>
                  <script type="text/javascript">
                      function jumlah(){
                          var bilangan1 = document.getElementById('totalHidden').value;
                          var bilangan2 = document.getElementById('pembayaran').value;
                          var tot = parseInt(bilangan1) - parseInt(bilangan2);
                          document.getElementById('kembalian').value = tot;
                      }
                  </script>
              </div>
          </div>
      </div>
  </div>
@endsection
    <!-- © 2020 Copyright: Tahu Coding -->
    <!-- Ini error harusnya bisa dinamis ambil value dari controller tp agar cepet ya biar aja gini silahkan modifikasi  -->
    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        @if(Session::has('error'))
            <script>
                toastr.error('Telah mencapai jumlah maximum Product | Silahkan tambah stock Product terlebih dahulu untuk menambahkan')
            </script>
        @endif
        @if(Session::has('errorTransaksi'))
            <script>
                toastr.error('Transaksi tidak valid | perhatikan jumlah pembayaran | cek jumlah product')
            </script>
        @endif

        @if(Session::has('success'))
            <script>
                toastr.success('Transaksi berhasil | Thank Your from Tahu Coding')
            </script>
        @endif
        <script  src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js">
        $(document).ready(function () {
            $('#fullHeightModalRight').on('shown.bs.modal', function () {
                $('#oke').trigger('focus');
            });
        });
        oke.oninput = function () {
            let jumlah = parseInt(document.getElementById('totalHidden').value);
            let bayar = parseInt(document.getElementById('oke').value);
            let hasil = bayar - jumlah;
            parseInt(document.getElementById('pembayaran').value) = bayar ;
            parseInt(document.getElementById('kembalian').value) = hasil;

            cek(bayar, jumlah);
            const saveButton = document.getElentById("saveButton");
        };

        function rupiah(bilangan) {
            var number_string = bilangan.toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

    </script>

    @endpush

    @push('style')
   <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <style>
        .gambar {
            width: 100%;
            height: 175px;
            padding: 0.9rem 0.9rem
        }

        @media only screen and (max-width: 600px) {
            .gambar {
                width: 100%;
                height: 100%;
                padding: 0.9rem 0.9rem
            }
        }

        html {
            overflow: scroll;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 0px;
            /* Remove scrollbar space */
            background: transparent;
            /* Optional: just make scrollbar invisible */
        }

        /* Optional: show position indicator in red */
        ::-webkit-scrollbar-thumb {
            background: #FF0000;
        }

        .cart-btn {
            position: absolute;
            display: block;
            top: 5%;
            right: 5%;
            cursor: pointer;
            transition: all 0.3s linear;
            padding: 0.6rem 0.8rem !important;

        }

        .productCard {
            cursor: pointer;

        }

        .productCard:hover {
            border: solid 1px rgb(172, 172, 172);

        }

    </style>
    <!-- © 2020 Copyright: Tahu Coding -->
    @endpush
