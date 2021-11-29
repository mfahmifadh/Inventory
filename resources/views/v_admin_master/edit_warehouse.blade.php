@extends('v_admin_master.layout.app')

@section('content')
    
    @foreach($warehouse as $data)
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
              <li class="breadcrumb-item active">Edit Data Gudang {{ $data->id_warehouse }}</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <!-- Input addon -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Edit Data Gudang</h3>
          </div>
          <div class="card-body">
            <form action="{{ url('admin-master/update_warehouse/'. $data->id_warehouse) }}" method="POST">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <label>Kode Gudang : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control" name="id_warehouse" value="{{ $data->id_warehouse }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Model Gudang :</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                    </div>
                    <select class="form-control" name="warehouse_category" required>
                      <option value="{{ $data->warehouse_category }}">{{ $data->warehouse_category }}</option>
                      <?php 
                      if ($data->warehouse_category == 'Palleting') {
                        echo '<option value="Racking">Racking</option>';
                      }else{
                        echo '<option value="Palleting">Palleting</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Nama Gudang : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                    </div>
                    <input type="text" class="form-control" name="warehouse_name" value="{{ $data->warehouse_name }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Status : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                    </div>
                    <select class="form-control" name="status_id" required>
                      <option value="{{ $data->status_id }}">{{ $data->status_name }}</option>
                      <?php 
                      if ($data->status_id == '1') {
                        echo '<option value="2">Tidak Aktif</option>';
                      }else{
                        echo '<option value="1">Aktif</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="input-group mb-3">
                    <label>Keterangan : </label>
                    <textarea class="form-control summernote" name="warehouse_description">
                      {!! $data->warehouse_description !!}
                    </textarea>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group mb-3">
                    <button type="submit" class="form-control btn btn-info" onclick="return confirm('Data sudah benar ?')">
                      <strong>UBAH</strong>
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
    @endforeach


@endsection