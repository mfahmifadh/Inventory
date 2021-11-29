@extends('v_admin_master.layout.app')

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
              <li class="breadcrumb-item"><a href="{{ url('admin-master/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Data Pengguna</li>
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
        <div class="card card-primary card-outline">   
          <div class="card-header">
              <h3 class="card-title left" style="float:left;margin-top: 0.5vh;"><b>DATA PENGGUNA</b></h3>
              <h3 class="card-title left" style="float:right;margin-top: 0.5vh;">
                <a href="{{ url('admin-master/create_user') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-circle"></i> PENGGUNA BARU
                </a>
              </h3>
          </div>
          <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-content-below-entryitem-tab" data-toggle="pill" href="#custom-content-below-entryitem" role="tab" aria-controls="custom-content-below-entryitem" aria-selected="true">Data Pengguna SATKER</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-content-below-exititem-tab" data-toggle="pill" href="#custom-content-below-exititem" role="tab" aria-controls="custom-content-below-exititem" aria-selected="false">Data Pengguna Petugas</a>
            </li>
          </ul>
          <div class="card-body">
            <div class="tab-content" id="custom-content-below-tabContent">
              <!-- Data Pengguna -->
              <div class="tab-pane fade show active" id="custom-content-below-entryitem" role="tabpanel" aria-labelledby="custom-content-below-entryitem-tab">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>ID SATKER</th>
                        <th>Role</th>
                        <th>Satuan Kerja</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                    @foreach($satker as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->workunit_id }}</td>
                        <td>{{ $data->role_name }}</td>
                        <td>{{ $data->workunit_name }}</td>
                        <td>{!! $data->full_name !!}</td>
                        <td>{!! $data->username !!}</td>
                        <td class="td-status">
                            @if($data->status_id == 1)
                                <a class="btn btn-success btn-xs disabled">Aktif</span>
                            @endif
                            @if($data->status_id == 2)
                                <a class="btn btn-danger btn-xs disabled">Tidak Aktif</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Role</th>
                        <th>Satuan Kerja</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Status</th>
                    </tr>
                    </tfoot>
                </table>
              </div>
              <!-- Data Petugas -->
              <div class="tab-pane fade" id="custom-content-below-exititem" role="tabpanel" aria-labelledby="custom-content-below-exititem-tab">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Role</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                    @foreach($petugas as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->role_name }}</td>
                        <td>{!! $data->full_name !!}</td>
                        <td>{!! $data->username !!}</td>
                        <td class="td-status">
                            @if($data->status_id == 1)
                                <a class="btn btn-success btn-xs disabled">Aktif</span>
                            @endif
                            @if($data->status_id == 2)
                                <a class="btn btn-danger btn-xs disabled">Tidak Aktif</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Role</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Status</th>
                    </tr>
                    </tfoot>
                </table>               
              </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.card -->

        </div>
      </div>
    </section>

@endsection