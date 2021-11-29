@extends('v_admin_master.layout.app')

@section('content')


  @foreach($pallet_slot as $data)
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Barang Keluar</h1>
            <b>Kode Order : {{ $data->id_order_data }}</b>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin-master/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/show_warehouse') }}">Data Gudang</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/detail_warehouse/'. $data->id_warehouse) }}">Detail Gudang {{ $data->id_warehouse }}</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/detail_slot/'. $data->id_slot) }}">Detail Slot {{ $data->id_slot }}</a></li>
              <li class="breadcrumb-item active">{{ $data->id_order_data }}</li>
            </ol>
          </div>
        </div><!-- /.row -->
        
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p style="color:white;margin: auto;">{{ $message }}</p>
                </div>
            @endif
            @if ($message = Session::get('failed'))
                <div class="alert alert-danger">
                    <p style="color:white;margin: auto;">{{ $message }}</p>
                </div>
            @endif
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p style="color:white;margin: auto;">{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('failed'))
            <div class="alert alert-danger">
                <p style="color:white;margin: auto;">{{ $message }}</p>
            </div>
        @endif
        <!-- Input addon -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title"><b>DAFTAR BARANG</b></h3>
          </div>
          <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Kategori Barang</th>
                <th>Nama Barang</th>
                <th>Berat</th>
                <th>Tinggi</th>
                <th>Jumlah Barang</th>
                <th>Deskripsi</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                @foreach($detailorder as $row)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $row->item_code }}</td>
                  <td>{{ $row->itemcategory_name }}</td>
                  <td>{{ $row->item_name }}</td>
                  <td>{{ $row->item_weight }}</td>
                  <td>{{ $row->item_height }}</td>
                  <td>{{ $row->item_qty }}</td>
                  <td>{{ $row->description }}</td>
                  </td>
                </tr>
                @endforeach
                      
              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Kategori Barang</th>
                <th>Nama Barang</th>
                <th>Berat</th>
                <th>Tinggi</th>
                <th>Jumlah Barang</th>
                <th>Deskripsi</th>
              </tr> 
              </tfoot>
            </table> 
          </div>
        </div>
      </div>
    </section>
  @endforeach


@endsection