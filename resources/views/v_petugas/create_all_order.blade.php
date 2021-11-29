@extends('v_petugas.layout.app')

@section('content')
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0">Data Gudang</h1>
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin-user/dashboard') }}">Dashboard</a></li>
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
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title"><b>TAMBAH DATA BARANG MASUK</b></h3>
          </div>
          <div class="card-body">
            <form action="{{ url('admin-user/add_order_all') }}" method="POST">
              @csrf
              <input type="hidden" name="id_order" class="form-control" value="PBM-{{ $order_id }}" readonly>
              <div class="row">
                <div class="col-md-6">
                  <label>NOMOR SURAT : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
             		   <input type="text" name="letter_num" class="form-control" placeholder="Masukan Nomor Surat" style="text-transform:uppercase;" required>
                  </div>
                  <hr>
                </div>
                <div class="col-md-6">
                  <label>DEADLINE PENYIMPANAN : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
             		    <input type="date" name="order_deadline" class="form-control" required>
                  </div>
                  <hr>
                </div>
                <div class="col-md-6">
                  <label>PETUGAS : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                    </div>
                    <select class="form-control" name="adminuser_id" readonly>
                      <option value="{{ Auth::id(); }}">{{ Auth::user()->full_name }}</option>
                    </select>
                  </div>
                  <hr>
                </div>
                <div class="col-md-6">
                  <label>SATUAN KERJA : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                    </div>
                    <select class="form-control" name="workunit_id" required>
                      <option value="">-- PILIH SATKER --</option>
                      @foreach($satker as $row)
                      <option value="{{ $row->workunit_id }}">{{ $row->full_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <hr>
                </div>
              </div>
              <br>
              <div class="add-more-pallet">
              	<div class="row">
	                <div class="col-md-6">
		                <label>PILIH GUDANG : </label>
		                <div class="input-group mb-3">
		                    <div class="input-group-prepend">
		                    	<span class="input-group-text"><i class="fas fa-warehouse"></i></span>
		                    </div>
		                    <select class="form-control" id="warehouse" required>
		                    	<option value="">-- PILIH GUDANG --</option>
		                     	@foreach($warehouse as $row)
		                     	<option value="{{ $row->id_warehouse }}" style="text-transform: uppercase;">{{ $row->warehouse_name }}</option>
		                     	@endforeach
		                   </select>
		                </div>
		            </div>
	              <div class="col-md-5">
		                <label>PILIH PALLET : </label>
		                <div class="input-group mb-3">
		                    <div class="input-group-prepend">
		                    	<span class="input-group-text"><i class="fas fa-pallet"></i></span>
		                    </div>
		                    <select class="form-control slot_iden" id="slot_id" name="slot_id[]" required><option value="">-- PILIH PALLET --</option></select>
		                </div>
		            </div>
	                <div class="col-md-1">
		                <label>&nbsp;</label>
		                <div class="input-group mb-3">
		                    <a id="add-more-pallet" class="form-control btn btn-primary"><i class="fas fa-plus-square"></i></a>
		                </div>
		            </div>
              	</div>
              <table class="table table-bordered table-striped add-more">
                <thead>
                  <tr>
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
                    <input type="hidden" name="id_order_data[]" value="PBM-{{ $idorderdata }}0">
                    <td>
                      <select class="form-control" name="itemcategory_id[]" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($itemcategory as $row)
                        <option value="{{ $row->id_item_category }}">{{ $row->itemcategory_name }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td><input type="text" name="item_name[]" class="form-control" placeholder="Nama Barang" required></td>
                    <td><input type="text" name="item_weight[]" class="form-control" placeholder="Contoh : 200 kg" required></td>
                    <td><input type="text" name="item_height[]" class="form-control" placeholder="Contoh : 200 cm" required></td>
                    <td><input type="number" name="item_qty[]" class="form-control" placeholder="Contoh : 200 " required></td>
                    <td><input type="text" name="description[]" class="form-control" placeholder="Keterangan Barang"></td>
                    <td align="center">
                      <a id="add-more-item" class="btn btn-primary btn-md"><i class="fas fa-plus-square"></i></a>
                      <input type="hidden" name="order_data_id[]" value="PBM-{{ $idorderdata }}0">
                    </td>
                  </tr>
                </tbody>
              </table>
              <hr>
          	  </div>
              <hr>
              <button type="submit" class="form-control btn btn-primary" onclick="return confirm('Data sudah benar ?')"><b>TAMBAH BARANG MASUK</b></button>
            </form>
            <!-- /input-group -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </section>

@endsection