@extends('v_petugas.layout.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin-user/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Riwayat Barang</li>
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
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title left" style="float:left;margin-top: 0.5vh;"><b>DATA RIWAYAT BARANG MASUK DAN KELUAR</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                 <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>JAM / TANGGAL</th>
                            <th>SATKER</th>
                            <th>NAMA BARANG</th>
                            <th>ID SLOT</th>
                            <th>GUDANG</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                    @foreach($history as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ date('H:i', strtotime($data->order_tm)) }} /
                            {{ date('d F Y', strtotime($data->order_dt)) }}</td>
                            <td>{{ $data->workunit_name }}</td>
                            <td>{{ $data->item_name }}</td>
                            <td>{{ $data->slot_id }}</td>
                            <td>{{ $data->warehouse_name }}</td>
                            <td class="td-status">
                                @if($data->item_status == 'Barang Masuk')
                                    <a class="btn btn-success btn-sm disabled">{{ $data->item_status }}</a>
                                @endif
                                @if($data->item_status == 'Barang Keluar')
                                    <a class="btn btn-danger btn-sm disabled">{{ $data->item_status }}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                      <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>JAM / TANGGAL</th>
                            <th>SATKER</th>
                            <th>NAMA BARANG</th>
                            <th>ID SLOT</th>
                            <th>GUDANG</th>
                            <th>STATUS</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
  </section>

@endsection