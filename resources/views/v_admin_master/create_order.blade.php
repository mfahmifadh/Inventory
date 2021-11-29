@extends('v_admin_master.layout.app')

@section('content')
    
    @foreach($slot as $data)
    @if($data->warehouse_category == 'Palleting')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0">Data Gudang</h1>
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin-master/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/show_warehouse') }}">Data Gudang</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/detail_warehouse/'. $data->id_warehouse) }}">Detail Gudang {{ $data->id_warehouse }}</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/detail_slot/'. $data->id_slot) }}">Detail Slot {{ $data->id_slot }}</a></li>
              <li class="breadcrumb-item active">Tambah Barang Masuk</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
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
        <!-- Input addon -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Tambah Data Barang Masuk</h3>
          </div>
          <div class="card-body">
            <form action="{{ url('admin-master/add_order') }}" method="POST">
              <input type="hidden" name="slot_id" value="{{ $data->id_slot }}">
              <input type="hidden" name="warehouse_category" value="{{ $data->warehouse_category }}">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <label>Petugas : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <select class="form-control" name="adminuser_id" required>
                      <option value="null">-- Pilih Petugas --</option>
                      @foreach($petugas as $petugas)
                      <option value="{{ $petugas->id }}">{{ $petugas->full_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <hr>
                </div>
                <div class="col-md-6">
                  <label>Satuan Kerja : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-portrait"></i></span>
                    </div>
                    <select class="form-control" name="workunit_id" required>
                      <option value="null">-- Pilih SATKER --</option>
                      @foreach($satker as $satker)
                      <option value="{{ $satker->id_workunit }}">{{ $satker->workunit_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <hr>
                </div>
              </div>
              <table id="example3" class="table table-bordered table-striped add-more">
                <thead>
                  <tr>
                    <th>Kode Barang</th>
                    <th>Kategori Barang</th>
                    <th>Nama Barang</th>
                    <th>Berat</th>
                    <th>Tinggi</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" name="item_code[]" class="form-control" placeholder="Kode Barang" required></td>
                    <td>
                      <select class="form-control" name="itemcategory_id[]" required>
                        <option>-- Pilih Kategori --</option>
                        @foreach($itemcategory as $itemcategory)
                        <option value="{{ $itemcategory->id_item_category }}">{{ $itemcategory->itemcategory_name }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td><input type="text" name="item_name[]" class="form-control" placeholder="Nama Barang" required></td>
                    <td><input type="text" name="item_weight[]" class="form-control" placeholder="Contoh : 200 kg" required></td>
                    <td><input type="text" name="item_height[]" class="form-control" placeholder="Contoh : 200 cm" required></td>
                    <td><input type="number" name="item_qty[]" class="form-control" placeholder="Contoh : 200 " required></td>
                    <td><input type="text" name="description[]" class="form-control" placeholder="Keterangan Barang"></td>
                    <td align="center">
                      <button type="button" id="add-more-item" class="btn btn-warning btn-md"><i class="fas fa-plus-square"></i></button>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Kode Barang</th>
                    <th>Kategori Barang</th>
                    <th>Nama Barang</th>
                    <th>Berat</th>
                    <th>Tinggi</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>
              <hr>
              <button type="submit" class="form-control btn btn-info btn-sm">SUBMIT</button>
            </form>
            <!-- /input-group -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </section>
    @endif
    @endforeach

    <!-- CREATE ORDER MODEL RACK -->

    @foreach($rack as $data)
    @if($data->warehouse_category == 'Racking')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0">Data Gudang</h1>
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin-master/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/show_warehouse') }}">Data Gudang</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/detail_warehouse/'. $data->id_warehouse) }}">Detail Gudang {{ $data->id_warehouse }}</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/detail_slot/'. $data->rack_pallet_id) }}">Detail Slot {{ $data->id_slot }} - {{ $data->rack_pallet_id }}</a></li>
              <li class="breadcrumb-item active">Tambah Barang Masuk</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
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
        <!-- Input addon -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Tambah Data Barang Masuk</h3>
          </div>
          <div class="card-body">
            <form action="{{ url('admin-master/add_order') }}" method="POST">
              <input type="hidden" name="rack_pallet_id" value="{{ $data->rack_pallet_id }}">
              <input type="hidden" name="warehouse_category" value="{{ $data->warehouse_category }}">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <label>Petugas : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <select class="form-control" name="adminuser_id" required>
                      <option value="null">-- Pilih Petugas --</option>
                      @foreach($petugas as $petugas)
                      <option value="{{ $petugas->id }}">{{ $petugas->full_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <hr>
                </div>
                <div class="col-md-6">
                  <label>Satuan Kerja : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-portrait"></i></span>
                    </div>
                    <select class="form-control" name="workunit_id" required>
                      <option value="null">-- Pilih SATKER --</option>
                      @foreach($satker as $satker)
                      <option value="{{ $satker->id_workunit }}">{{ $satker->workunit_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <hr>
                </div>
              </div>
              <table id="example3" class="table table-bordered table-striped add-more">
                <thead>
                  <tr>
                    <th>Kode Barang</th>
                    <th>Kategori Barang</th>
                    <th>Nama Barang</th>
                    <th>Berat</th>
                    <th>Tinggi</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" name="item_code[]" class="form-control" placeholder="Kode Barang" required></td>
                    <td>
                      <select class="form-control" name="itemcategory_id[]" required>
                        <option>-- Pilih Kategori --</option>
                        @foreach($itemcategory as $itemcategory)
                        <option value="{{ $itemcategory->id_item_category }}">{{ $itemcategory->itemcategory_name }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td><input type="text" name="item_name[]" class="form-control" placeholder="Nama Barang" required></td>
                    <td><input type="text" name="item_weight[]" class="form-control" placeholder="Contoh : 200 kg" required></td>
                    <td><input type="text" name="item_height[]" class="form-control" placeholder="Contoh : 200 cm" required></td>
                    <td><input type="number" name="item_qty[]" class="form-control" placeholder="Contoh : 200 " required></td>
                    <td><input type="text" name="description[]" class="form-control" placeholder="Keterangan Barang"></td>
                    <td align="center">
                      <button type="button" id="add-more-item" class="btn btn-warning btn-md"><i class="fas fa-plus-square"></i></button>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Kode Barang</th>
                    <th>Kategori Barang</th>
                    <th>Nama Barang</th>
                    <th>Berat</th>
                    <th>Tinggi</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>
              <hr>
              <button type="submit" class="form-control btn btn-info btn-sm">SUBMIT</button>
            </form>
            <!-- /input-group -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </section>
    @endif
    @endforeach

@endsection