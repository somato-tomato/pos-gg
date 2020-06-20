@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <input class="btn btn-primary" type="button" value="Tambah Supplier">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Supplier</h4>
            <p class="card-category">Data Supplier</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    Kode
                  </th>
                  <th>
                    Nama Supplier
                  </th>
                  <th>
                    No Hp
                  </th>
                  <th>
                    Aksi
                  </th>
                </thead>
                <tbody>
                    <tr>
                        <td>

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
</div>
@endsection
