@extends('v_petugas.layout.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin-user/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Data Barang Masuk</li>
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
                <h3 class="card-title"><b>DATA BARANG MASUK</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Jam/Tanggal</th>
                        <th>Nama Barang</th>
                        <th>ID Pallet</th>
                        <th>SATKER</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                    @foreach($entryitem as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->order_tm)->isoFormat('H:m') }} /
                            {{ \Carbon\Carbon::parse($data->order_dt)->isoFormat('DD MMM Y') }}</td>
                        <td>{{ $data->item_name }}</td>
                        <td>{{ $data->slot_id }}</td>
                        <td>{{ $data->workunit_name }}</td>
                        <td class="td-status">
                            <a class="btn btn-success btn-sm disabled" style="text-transform:uppercase;font-weight: bold;">
                                {{ $data->item_status }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                      <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Jam/Tanggal</th>
                        <th>Nama Barang</th>
                        <th>ID Pallet</th>
                        <th>SATKER</th>
                        <th>Status</th>
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