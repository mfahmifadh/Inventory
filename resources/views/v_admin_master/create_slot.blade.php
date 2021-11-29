@extends('v_admin_master.layout.app')

@section('content')

    @foreach($slot as $data)
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
              <li class="breadcrumb-item">
                <a href="{{ url('admin-master/detail_warehouse/'. $data->id_warehouse) }}">
                  Detail Gudang {{ $data->id_warehouse }}
                </a>
              </li>
              <li class="breadcrumb-item active">Tambah Slot Gudang</li>
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
            <h3 class="card-title">Tambah Slot Gudang {{ $data->id_warehouse }}</h3>
          </div>
          <div class="card-body">
            <!-- Form Add  Slot Palleting -->
            @if($data->warehouse_category == 'Palleting')
            <form action="{{ url('admin-master/add_slot') }}" method="POST">
              @csrf
              <input type="hidden" name="slot_status" value="Tersedia">
              <div class="row">
                <div class="col-md-6">
                  <label>Kode Gudang : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control" name="warehouse_id" value="{{ $data->id_warehouse }}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Model Gudang :</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                    </div>
                    <select class="form-control" readonly>
                      <option value="warehouse_category">{{ $data->warehouse_category }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Nama Gudang : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                    </div>
                    <input type="text" class="form-control" value="{{ $data->warehouse_name }}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Kode Pallet : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control" name="id_slot" placeholder="Contoh : G09-01" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group mb-3">
                    <button type="submit" class="form-control btn btn-info" onclick="return confirm('Data sudah benar ?')">
                      <strong>TAMBAH</strong>
                    </button>
                  </div>
                </div>
              </div>
            </form>
            @endif
            <!-- Form Add Slot Racking -->
            @if($data->warehouse_category == 'Racking')
            <form action="{{ url('admin-master/add_slot') }}" method="POST">
              @csrf
              <input type="hidden" name="slot_status" value="Tersedia">
              <input type="hidden" name="rack_pallet_status" value="Tersedia">
              <input type="hidden" name="slot_category" value="{{ $data->warehouse_category }}">
              <div class="row">
                <div class="col-md-4">
                  <label>Kode Gudang : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control" name="warehouse_id" value="{{ $data->id_warehouse }}" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Model Gudang :</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                    </div>
                    <select class="form-control" readonly>
                      <option value="warehouse_category">{{ $data->warehouse_category }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Nama Gudang : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                    </div>
                    <input type="text" class="form-control" value="{{ $data->warehouse_name }}" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Kode Rack : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control" name="id_slot" placeholder="Kode Rack" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Tingkat Rack : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-level-up-alt"></i></span>
                    </div>
                    <select class="form-control"  name="rack_level">
                      <option>-- Pilih Tingkat Rack --</option>
                      <option value="Tingkat 1">Tingkat 1</option>
                      <option value="Tingkat 2">Tingkat 2</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Kode Pallet : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-pallet"></i></span>
                    </div>
                    <input type="text" class="form-control" name="rack_pallet_id" placeholder="Kode Pallet" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group mb-3">
                    <button type="submit" class="form-control btn btn-info" onclick="return confirm('Data sudah benar ?')">
                      <strong>TAMBAH</strong>
                    </button>
                  </div>
                </div>
              </div>
            </form>
            @endif
            <!-- /input-group -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </section>
    @endforeach


@endsection