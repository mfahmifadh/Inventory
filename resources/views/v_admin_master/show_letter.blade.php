@extends('v_admin_master.layout.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Arsip Surat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin-master/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Data Surat</li>
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
                <h3 class="card-title left" style="float:left;margin-top: 0.5vh;">
                    <b>ARSIP SURAT MASUK & KELUAR</b>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Order</th>
                        <th>SATKER</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                    @foreach($letter as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->id_order }}</td>
                        <td>{{ $data->workunit_name }}</td>
                        <td>{{ date('H:i', strtotime($data->order_tm)) }} /
                            {{ \Carbon\Carbon::parse($data->order_dt)->isoFormat('DD MMMM Y') }}</td>
                        <td class="td-status">
                            @if ($data->order_category == 'Pengiriman')
                                <a class="btn btn-success btn-sm disabled"><b>BARANG MASUK</b></a></td>
                            @endif
                            @if ($data->order_category == 'Pengambilan')
                                <a class="btn btn-danger btn-sm disabled"><b>BARANG KELUAR</b></a></td>
                            @endif
                        <td class="td-status">
                            <a href="{{ url('admin-master/detail_letter/'. $data->id_order) }}" class="btn btn-primary btn-sm">DETAIL</a>
                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                      <tfoot>
                    <tr>
                        <th>No</th>
                        <th>ID Order</th>
                        <th>SATKER</th>
                        <th>Tanggal</th>
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