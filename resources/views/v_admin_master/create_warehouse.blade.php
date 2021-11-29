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
              <li class="breadcrumb-item"><a href="{{ url('admin-master/show_warehouse') }}">Data Gudang</a></li>
              <li class="breadcrumb-item active">Tambah Data Gudang</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <!-- Input addon -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Tambah Data Gudang</h3>
          </div>
          <div class="card-body">
            <form action="{{ url('admin-master/add_warehouse') }}" method="POST">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <label>Kode Gudang : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control" name="id_warehouse" placeholder="Kode Gudang" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Model Gudang :</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                    </div>
                    <select class="form-control" name="warehouse_category" required>
                      <option>-- Pilih Model Gudang --</option>
                      <option value="Racking">Racking</option>
                      <option value="Palleting">Palleting</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Nama Gudang : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                    </div>
                    <input type="text" class="form-control" name="warehouse_name" placeholder="Nama Gudang" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Status : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                    </div>
                    <select class="form-control" name="status_id" required>
                      <option value="1">-- Pilih Status --</option>
                      <option value="1">Aktif</option>
                      <option value="2">Tidak Aktif</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="input-group mb-3">
                    <label>Keterangan : </label>
                    <textarea class="form-control summernote" name="warehouse_description"></textarea>
                  </div>
                </div>
                <div class="col-md-3">
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