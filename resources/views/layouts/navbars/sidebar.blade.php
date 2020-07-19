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
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'supplier' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('supplier.index') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Supplier') }}</p>
        </a>
      </li>
        <li class="nav-item{{ $activePage == 'barang' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('barang.index') }}">
                <i class="material-icons">content_paste</i>
                <p>{{ __('Barang') }}</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'kategori' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('kategori.dex') }}">
                <i class="material-icons">content_paste</i>
                <p>{{ __('Kategori') }}</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'rak' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('rak.dex') }}">
                <i class="material-icons">content_paste</i>
                <p>{{ __('Rak Barang') }}</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'barangSup' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('bSupplier.index') }}">
                <i class="material-icons">content_paste</i>
                <p>{{ __('Supplier - Barang') }}</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'minStock' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('stock.warn') }}">
                <i class="material-icons">content_paste</i>
                <p>{{ __('Stock Kurang') }}</p>
            </a>
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
    </ul>
  </div>
</div>
