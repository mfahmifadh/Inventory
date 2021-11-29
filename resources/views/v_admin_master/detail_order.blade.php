@extends('v_admin_master.layout.app')

@section('content')

	@foreach($warehouse09 as $data)
	@if($data->warehouse_category == "Palleting")
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
              <li class="breadcrumb-item active">Detail Barang Masuk {{ $data->order_id }}</li>
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

	<!-- CONTENT GUDANG 09 PALLETING -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">   
          <div class="card-header">
              <h3 class="card-title left" style="float:left;margin-top: 0.5vh;">Data Barang Masuk - <b>{{ $data->order_id }}</b></h3>
          </div>
          <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
               <thead>
               <tr>
                 <th>No</th>
                 <th>Kode</th>
                 <th>Kategori Barang</th>
                 <th>Nama Barang</th>
                 <th>Berat</th>
                 <th>Tinggi</th>
                 <th>Jumlah Barang</th>
                 <th>Deskripsi</th>
               </tr>
               </thead>
               <tbody>
               <?php $no=1;?>
               @foreach($entryitem as $detailorder)
               <tr>
                 <td>{{ $no++ }}</td>
                 <td>{{ $detailorder->item_code }}</td>
                 <td>{{ $detailorder->itemcategory_name }}</td>
                 <td>{{ $detailorder->item_name }}</td>
                 <td>{{ $detailorder->item_weight }}</td>
                 <td>{{ $detailorder->item_height }}</td>
                 <td>{{ $detailorder->item_qty }}</td>
                 <td>{{ $detailorder->description }}</td>
               </tr>
               @endforeach
               </tbody>
               <tfoot>
               <tr>
                 <th>No</th>
                 <th>Kode</th>
                 <th>Kategori Barang</th>
                 <th>Nama Barang</th>
                 <th>Berat</th>
                 <th>Tinggi</th>
                 <th>Jumlah Barang</th>
                 <th>Deskripsi</th>
               </tr>
               </tfoot>
           	</table>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.card -->
      </div>
  	</section>    
    @endif
    @endforeach


	@foreach($warehouse05B as $data)
	@if($data->warehouse_category == "Racking")
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
              <li class="breadcrumb-item"><a href="{{ url('admin-master/detail_slot/'. $data->slot_id) }}">Detail Slot {{ $data->id_slot }} - {{ $data->slot_id }}</a></li>
              <li class="breadcrumb-item active">Detail Barang Masuk {{ $data->order_id }}</li>
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

    <!-- CONTENT GUDANG 05B RACKING -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">   
          <div class="card-header">
              <h3 class="card-title left" style="float:left;margin-top: 0.5vh;">Data Barang Masuk - <b>{{ $data->order_id }}</b></h3>
          </div>
          <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
               <thead>
               <tr>
                 <th>No</th>
                 <th>Kode</th>
                 <th>Kategori Barang</th>
                 <th>Nama Barang</th>
                 <th>Berat</th>
                 <th>Tinggi</th>
                 <th>Jumlah Barang</th>
                 <th>Deskripsi</th>
               </tr>
               </thead>
               <tbody>
               <?php $no=1;?>
               @foreach($entryitem as $detailorder)
               <tr>
                 <td>{{ $no++ }}</td>
                 <td>{{ $detailorder->item_code }}</td>
                 <td>{{ $detailorder->itemcategory_name }}</td>
                 <td>{{ $detailorder->item_name }}</td>
                 <td>{{ $detailorder->item_weight }}</td>
                 <td>{{ $detailorder->item_height }}</td>
                 <td>{{ $detailorder->item_qty }}</td>
                 <td>{{ $detailorder->description }}</td>
                 </td>
               </tr>
               @endforeach
               </tbody>
               <tfoot>
               <tr>
                 <th>No</th>
                 <th>Kode</th>
                 <th>Kategori Barang</th>
                 <th>Nama Barang</th>
                 <th>Berat</th>
                 <th>Tinggi</th>
                 <th>Jumlah Barang</th>
                 <th>Deskripsi</th>
               </tr>
               </tfoot>
           	</table>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.card -->

      </div>
  </section> 

    @endif
    @endforeach




@endsection