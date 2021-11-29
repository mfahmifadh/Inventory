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
              <li class="breadcrumb-item active">Data Gudang</li>
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
                <h3 class="card-title left" style="float:left;margin-top: 0.5vh;"><b>DATA GUDANG KEMENKES</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Model</th>
                        <th>Nama Gudang</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                    @foreach($warehouse as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->id_warehouse }}</td>
                        <td>{{ $data->warehouse_category }}</td>
                        <td>{{ $data->warehouse_name }}</td>
                        <td>{!! $data->warehouse_description !!}</td>
                        <td class="td-status">
                            @if($data->status_id == 1)
                                <a class="btn btn-success btn-xs disabled">Aktif</span>
                            @endif
                            @if($data->status_id == 2)
                                <a class="btn btn-danger btn-xs disabled">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="td-aksi">        
                            <a href="{{ url('admin-user/detail_warehouse/'. $data->id_warehouse) }}" class="btn btn-info btn-xs">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                      <tfoot>
                    <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Model</th>
                    <th>Nama Gudang</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
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