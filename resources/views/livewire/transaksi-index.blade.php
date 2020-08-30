<div class="content">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

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
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Barang Masuk</h4>
                        <p class="card-category">Data Barang Masuk</p>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
