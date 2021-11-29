@extends('v_admin_master.layout.app')

@section('content')
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Gudang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin-master/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/show_user') }}">Data User</a></li>
              <li class="breadcrumb-item active">Tambah Data User</li>
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

    <section class="content">
      <div class="container-fluid">
        <!-- Input addon -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Tambah Data User</h3>
          </div>
          <div class="card-body">
            <form action="{{ url('admin-master/add_user') }}" method="POST">
              @csrf
              <div class="row">
                <div class="col-md-4">
                  <label>Nomor Induk Karyawan (NIK) : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control" name="id" placeholder="Masukan NIK" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Nama Petugas / SATKER : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="full_name" placeholder="Masukan Nama Petugas / Satker" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Pilih Role :</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    </div>
                    <select class="form-control" name="role_id" required>
                      <option value="">-- Pilih Role --</option>
                      <option value="1">ADMIN MASTER</option>
                      <option value="2">PETUGAS</option>
                      <option value="3">SATUAN KERJA (SATKER)</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Pilih Satuan Kerja (Jika SATKER) : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <select class="form-control" name="workunit_id">
                      <option value="">-- Pilih Satuan Kerja --</option>
                      @foreach($workunit as $workunit)
                      <option value="{{ $workunit->id_workunit }}">{{ $workunit->workunit_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Username : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                    </div>
                    <input type="text" class="form-control" name="username" placeholder="Masukan Username" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Password : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><button onclick="myFunction()" class="fas fa-eye"></button></span>
                    </div>
                    <input type="password" class="form-control" name="password" id="myInput" placeholder="Masukan Password" minlength="8" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Pilih Status : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list"></i></span>
                    </div>
                    <select class="form-control" name="status_id" required>
                      <option value="1">Aktif</option>
                      <option value="2">Tidak Aktif</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <label>&nbsp;</label>
                  <div class="input-group mb-3">
                    <button type="submit" class="form-control btn btn-secondary" onclick="return confirm('Data sudah benar ?')">
                      <strong>TAMBAH</strong>
                    </button>
                  </div>
                </div>
              </div>
            </form>
            <!-- /input-group -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </section>
    <br>


@endsection