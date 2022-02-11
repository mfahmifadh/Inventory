@extends('v_petugas.layout.app')

@section('content')
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0">Proses Barang Keluar</h1>
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin-user/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Tambah Barang Keluar</li>
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
        <div class="card card-warning">
          <div class="card-header">
            <div class="card-title"><b>SOP</b></div>
          </div>
          <div class="card-body">
            <!-- sop tata cara pengisian data barang keluar -->
          </div>
        </div>

        <!-- Input addon -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title"><b>TAMBAH DATA BARANG KELUAR</b></h3>
          </div>
          <div class="card-body">
            <form action="{{ url('admin-user/add_exit_order') }}" method="POST">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <label>ID Order : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" name="id_order" class="form-control" value="PBK-{{ $order_id }}" readonly>
                  </div>
                  <hr>
                </div>
                <div class="col-md-6">
                  <label>PETUGAS : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                    </div>
                    <select class="form-control" name="adminuser_id" readonly>
                      <option value="{{ Auth::id(); }}">{{ Auth::user()->full_name; }}</option>
                    </select>
                  </div>
                  <hr>
                </div>
                <div class="col-md-6">
                  <label>SATUAN KERJA : </label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-users"></i></span>
                    </div>
                    <select class="form-control" id="exitsatker" name="workunit_id" required>
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
		                    <select class="form-control" id="exitwarehouse" required><option value="">-- PILIH GUDANG --</option></select>
		                </div>
		            </div>
	              <div class="col-md-5">
		                <label>PILIH PALLET : </label>
		                <div class="input-group mb-3">
		                    <div class="input-group-prepend">
		                    	<span class="input-group-text"><i class="fas fa-pallet"></i></span>
		                    </div>
		                    <select class="form-control setorderdataid slot_idex" id="exitpallet" name="slot_id[]" required><option value="">-- PILIH PALLET --</option></select>
		                </div>
		            </div>
                <span id="getorderdataid"></span>
	              <div class="col-md-1">
		              <label>&nbsp;</label>
		              <div class="input-group mb-3">
		                  <a id="exit-add-more-pallet" class="form-control btn btn-primary"><i class="fas fa-plus-square"></i></a>
		              </div>
		            </div>
              	</div>
              <table id="example3" class="table table-bordered table-striped add-more">
                <thead>
                  <tr>
                    <th>Barang</th>
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
                    <input type="hidden" name="id_order_data[]" value="PBK-{{ $idorderdata }}0">
                    <td>
                      <select class="form-control itemcode" id="itemcode" name="item_code[]" required><option value="">-- Pilih Barang --</option></select>
                    </td>
                    <td><span id="itemcategory"></span></td>
                    <td><span id="itemname"></span></td>
                    <td><span id="itemweight"> </span></td>
                    <td><span id="itemheight"> </span></td>
                    <td><span id="itemqty"> </span></td>
                    <td><span id="itemdescription"> </span></td>
                    <td align="center">
                      <a id="exit-add-more-item" class="btn btn-primary btn-md"><i class="fas fa-plus-square"></i></a>
                      <input type="hidden" name="order_data_id[]" value="PBK-{{ $idorderdata }}0">
                    </td>
                  </tr>
                </tbody>
              </table>
          	  </div>
              <hr>
              <button type="submit" class="form-control btn btn-primary btn-sm" onclick="return confirm('Data sudah benar ?')">TAMBAH BARANG KELUAR</button>
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