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
                <h3 class="card-title left" style="float:left;margin-top: 0.5vh;"><b>DATA SATUAN KERJA</b></h3>
                    <h3 class="card-title right" style="float:right;">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-workunit">
                        <i class="fas fa-plus-circle"></i> SATKER
                    </a>
                    </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                 <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>SATKER</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                    @foreach($workunit as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->workunit_name }}</td>
                        <td>{{ $row->status_name }}</td>
                        <td class="td-status">
                            <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit-workunit{{$row->id_workunit}}"><b>EDIT</b></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                      <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>SATKER</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
  </section>

  <div class="modal fade" id="modal-add-workunit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Satuan Kerja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('admin-master/add_workunit') }}" method="POST">
                @csrf
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Nama Satuan Kerja (SATKER) :</label>
                            <input type="text" class="form-control" name="workunit_name" placeholder="Masukan Satuan Kerja" style="text-transform: uppercase;" required>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @foreach($workunit as $row)
    <div class="modal fade" id="modal-edit-workunit{{ $row->id_workunit }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Edit Kategori Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin-master/edit_workunit/'. $row->id_workunit) }}" method="POST">
                @csrf
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <label>Satuan Kerja (SATKER) :</label>
                            <input type="text" class="form-control" name="workunit_name" style="text-transform: uppercase;" value="{{ $row->workunit_name }}">
                        </div>
                        <div class="col-md-4">
                            <label>Status :</label>
                            <select class="form-control" name="status_id">
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach

@endsection