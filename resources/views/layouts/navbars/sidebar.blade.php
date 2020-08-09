<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __('Creative Tim') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      @if($navToko === null)
            <li class="nav-item{{ $activePage == 'toko' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('toko.index') }}">
                    <i class="material-icons">content_paste</i>
                    <p>{{ __('Toko') }}</p>
                </a>
            </li>
      @else
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item {{ ($activePage == 'toko' || $activePage == 'kategori' || $activePage == 'rak') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#tokoMenu" aria-expanded="false">
                    <i class="material-icons">store</i>
                    <p>{{ __('Pengaturan Toko') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="tokoMenu">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'toko' ? ' active' : '' }}">
                            <a class="nav-link" ref="{{ route('toko.index') }}">
                                <span class="sidebar-mini"> T </span>
                                <span class="sidebar-normal">{{ __('Toko') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'kategori' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('kategori.dex') }}">
                                <span class="sidebar-mini"> K </span>
                                <span class="sidebar-normal">{{ __('Kategori Barang') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'rak' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('rak.dex') }}">
                                <span class="sidebar-mini"> R </span>
                                <span class="sidebar-normal">{{ __('Rak / Lokasi') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ ($activePage == 'barang' || $activePage == 'kategori' || $activePage == 'rak') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#barangMenu" aria-expanded="false">
                    <i class="material-icons">all_inbox</i>
                    <p>{{ __('Barang') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="barangMenu">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'barang' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('barang.index') }}">
                                <span class="sidebar-mini"> B </span>
                                <span class="sidebar-normal">{{ __('Barang / Produk') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'kategori' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('kategori.dex') }}">
                                <span class="sidebar-mini"> K </span>
                                <span class="sidebar-normal">{{ __('Kategori Barang') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'rak' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('rak.dex') }}">
                                <span class="sidebar-mini"> R </span>
                                <span class="sidebar-normal">{{ __('Rak / Lokasi') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ ($activePage == 'supplier' || $activePage == 'barangSup') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#supplierMenu" aria-expanded="false">
                    <i class="material-icons">group</i>
                    <p>{{ __('Supplier') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="supplierMenu">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'supplier' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('supplier.index') }}">
                                <i class="material-icons"> S </i>
                                <p>{{ __('Supplier') }}</p>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'barangSup' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('bSupplier.index') }}">
                                <i class="material-icons">BS</i>
                                <p>{{ __('Barang Supplier') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ ($activePage == 'stock' || $activePage == 'minStock') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#stockMenu" aria-expanded="false">
                    <i class="material-icons">assignment</i>
                    <p>{{ __('Stock Barang') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="stockMenu">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'stock' ? ' active' : '' }}">
                            <a class="nav-link" href="#">
                                <i class="material-icons"> S </i>
                                <p>{{ __('Tambah Stock') }}</p>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'minStock' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('stock.warn') }}">
                                <span class="sidebar-mini"> SK </span>
                                <span class="sidebar-normal">{{ __('Stock Kurang') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item{{ $activePage == 'order' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('trans.dex') }}">
                    <i class="material-icons">content_paste</i>
                    <p>{{ __('Transaksi') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'nojs' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('noJS.first') }}">
                    <i class="material-icons">content_paste</i>
                    <p>{{ __('Transaksi NO JS') }}</p>
                </a>
            </li>
      @endif
    </ul>
  </div>
</div>
