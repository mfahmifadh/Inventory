@extends('v_admin_master.layout.app')

@section('content')


  @foreach($pallet_slot as $data)
  @if($data->warehouse_category == 'Palleting')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin-master/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/show_warehouse') }}">Data Gudang</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/detail_warehouse/'. $data->id_warehouse) }}">Detail Gudang {{ $data->id_warehouse }}</a></li>
              <li class="breadcrumb-item active">Detail Slot {{ $data->id_slot }}</li>
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
          <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-content-below-entryitem-tab" data-toggle="pill" href="#custom-content-below-entryitem" role="tab" aria-controls="custom-content-below-entryitem" aria-selected="true"><i class="fas fa-people-carry"></i> Barang Masuk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-content-below-exititem-tab" data-toggle="pill" href="#custom-content-below-exititem" role="tab" aria-controls="custom-content-below-exititem" aria-selected="false">
                <i class="fas fa-truck-loading"></i> Barang Keluar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-content-below-history-tab" data-toggle="pill" href="#custom-content-below-history" role="tab" aria-controls="custom-content-below-history" aria-selected="false">
              <i class="fas fa-history"></i> Riwayat</a>
            </li>
          </ul>
          <div class="card-body">
            <div class="tab-content" id="custom-content-below-tabContent">
              <!-- Barang Masuk -->
              <div class="tab-pane fade show active" id="custom-content-below-entryitem" role="tabpanel" aria-labelledby="custom-content-below-entryitem-tab">
                @foreach($pbm_pallet_orderid as $palletorderid)
                <div class="row">
                  <div class="col-md-9">
                    <h6>Kode Pengiriman : 
                      <b>{{ $palletorderid->id_order }}</b>
                    </h6>
                  </div>
                  <div class="col-md-3">
                    <h6>Tanggal Masuk <span style="margin-right:4vh;"></span>: <b>{{ date('d F Y', strtotime($palletorderid->order_dt)) }}</b></h6>
                  </div>
                  <div class="col-md-9">
                    <h6>Satuan Kerja <span style="margin-right:4vh;"></span>:
                      <b>{{ $palletorderid->workunit_name }}</b></h6>
                  </div>
                  <div class="col-md-3">
                    <h6>Tanggal Deadline <span style="margin-right:2vh;"></span>: <b>{{ date('d F Y', strtotime($palletorderid->order_deadline)) }}</b></h6>
                  </div>
                </div>
                @endforeach
                <br>
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
                    @foreach($pbm_entry as $entryitem)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $entryitem->item_code }}</td>
                      <td>{{ $entryitem->itemcategory_name }}</td>
                      <td>{{ $entryitem->item_name }}</td>
                      <td>{{ $entryitem->item_weight }}</td>
                      <td>{{ $entryitem->item_height }}</td>
                      <td>{{ $entryitem->item_qty }}</td>
                      <td>{{ $entryitem->description }}</td>
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
              <!-- Barang Keluar -->
              <div class="tab-pane fade" id="custom-content-below-exititem" role="tabpanel" aria-labelledby="custom-content-below-exititem-tab">
                <b><h5>{{ $data->id_slot }} - Data Barang Keluar</h5></b>
                <table id="example2a" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Jam / Tanggal</th>
                      <th>Order ID</th>
                      <th>Pallet ID</th>
                      <th>Total Barang</th>
                      <th>SATKER</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                    @foreach($pbk_exit as $entryitem)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ date('H:i', strtotime($entryitem->order_tm)) }} /
                          {{ date('d F Y', strtotime($entryitem->order_dt)) }}</td>
                      <td>{{ $entryitem->order_id }}</td>
                      <td>{{ $entryitem->slot_id }}</td>
                      <td>{{ $entryitem->total_item }} Barang</td>
                      <td>{{ $entryitem->workunit_name }}</td>  
                      <td class="td-status">
                        <a href="{{ url('admin-master/detail_exit_order/' . $entryitem->id_order_data )}}" class="btn btn-info btn-xs"><b>DETAIL</b></a></td>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Jam - Tanggal</th>
                      <th>Order ID</th>
                      <th>Pallet ID</th>
                      <th>Total Barang</th>
                      <th>SATKER</th>
                      <th>Aksi</th>
                    </tr> 
                    </tfoot>
                </table>
              </div>
              <!-- Riwayat -->
              <div class="tab-pane fade" id="custom-content-below-history" role="tabpanel" aria-labelledby="custom-content-below-history-tab">
                <b><h5>{{ $data->id_slot }} - Riwayat Barang masuk & Keluar</h5></b>
                <table id="example2b" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Order ID</th>
                      <th>Nama Barang</th>
                      <th>Jumlah Barang</th>
                      <th>SATKER</th>
                      <th>Jam/Tgl Masuk</th>
                      <th>Jam/Tgl Keluar</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                    @foreach($pallet_history as $history)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $history->order_id }}</td>
                      <td>{{ $history->item_name }}</td>
                      <td>{{ $history->item_qty }}</td>
                      <td>{{ $history->workunit_name }}</td>
                      <td>{{ date('H:i', strtotime($history->item_entry_date)) }} / 
                          {{ date('d F Y', strtotime($history->item_entry_date)) }}</td>
                      <td>
                          @if($history->item_exit_date == '')
                            <b> - </b>
                          @endif
                          @if($history->item_exit_date != '')
                            {{ date('H:i', strtotime($history->item_exit_date)) }} / 
                            {{ date('d F Y', strtotime($history->item_exit_date)) }}
                          @endif
                      </td>
                      <td class="td-status">
                        @if($history->item_status == 'Barang Masuk')
                          <a class="btn btn-success btn-xs disabled">BARANG MASUK</span>
                        @endif
                        @if($history->item_status == 'Barang Keluar')
                          <a class="btn btn-danger btn-xs disabled">BARANG KELUAR</span>
                        @endif
                      </td>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Order ID</th>
                      <th>Nama Barang</th>
                      <th>Jumlah Barang</th>
                      <th>SATKER</th>
                      <th>Tanggal Masuk</th>
                      <th>Tanggal Keluar</th>
                      <th>Status</th>
                    </tr> 
                    </tfoot>
                </table>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.card -->
      </div>
  </section>
  @endif
  @endforeach

  <!-- DATA SLOT MODEL RAK -->

  @foreach($rack_slot as $data)
  @if($data->warehouse_category == 'Racking')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin-master/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/show_warehouse') }}">Data Gudang</a></li>
              <li class="breadcrumb-item"><a href="{{ url('admin-master/detail_warehouse/'. $data->id_warehouse) }}">Detail Gudang {{ $data->id_warehouse }}</a></li>
              <li class="breadcrumb-item active">Detail Slot {{ $data->id_slot }} - {{ $data->id_slot }}</li>
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
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-content-below-entryitem-tab" data-toggle="pill" href="#custom-content-below-entryitem" role="tab" aria-controls="custom-content-below-entryitem" aria-selected="true"><i class="fas fa-people-carry"></i> Barang Masuk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-content-below-exititem-tab" data-toggle="pill" href="#custom-content-below-exititem" role="tab" aria-controls="custom-content-below-exititem" aria-selected="false">
                <i class="fas fa-truck-loading"></i> Barang Keluar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-content-below-history-tab" data-toggle="pill" href="#custom-content-below-history" role="tab" aria-controls="custom-content-below-history" aria-selected="false">
              <i class="fas fa-history"></i> Riwayat</a>
            </li>
        </ul>
        <div class="card-body">
          <div class="tab-content" id="custom-content-below-tabContent">
            <!-- Barang Masuk -->
            <div class="tab-pane fade show active" id="custom-content-below-entryitem" role="tabpanel" aria-labelledby="custom-content-below-entryitem-tab">
                @foreach($pbm_pallet_orderid as $palletorderid)
                <div class="row">
                  <div class="col-md-9">
                    <h6>Kode Pengiriman : 
                      <b>{{ $palletorderid->id_order }}</b>
                    </h6>
                  </div>
                  <div class="col-md-3">
                    <h6>Tanggal Masuk <span style="margin-right:4vh;"></span>: <b>{{ date('d F Y', strtotime($palletorderid->order_dt)) }}</b></h6>
                  </div>
                  <div class="col-md-9">
                    <h6>Satuan Kerja <span style="margin-right:4vh;"></span>:
                      <b>{{ $palletorderid->workunit_name }}</b></h6>
                  </div>
                  <div class="col-md-3">
                    <h6>Tanggal Deadline <span style="margin-right:2vh;"></span>: <b>{{ date('d F Y', strtotime($palletorderid->order_deadline)) }}</b></h6>
                  </div>
                </div>
                @endforeach
                <br>
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
                  @foreach($pbm_entryrack as $detailorder)
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
            <!-- Barang Keluar -->
            <div class="tab-pane fade" id="custom-content-below-exititem" role="tabpanel" aria-labelledby="custom-content-below-exititem-tab">
                <b><h5>{{ $data->id_slot }} - Data Barang Keluar</h5></b>
                <br>
                <table id="example2a" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Jam / Tanggal</th>
                      <th>Order ID</th>
                      <th>Pallet ID</th>
                      <th>Total Barang</th>
                      <th>SATKER</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                    @foreach($pbk_exitrack as $entryitem)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ date('H:i', strtotime($entryitem->order_tm)) }} /
                          {{ date('d F Y', strtotime($entryitem->order_dt)) }}</td>
                      <td>{{ $entryitem->order_id }}</td>
                      <td>{{ $entryitem->slot_id }}</td>
                      <td>{{ $entryitem->total_item }} Barang</td>
                      <td>{{ $entryitem->workunit_name }}</td>  
                      <td class="td-status">
                        <a href="{{ url('admin-master/detail_exit_order/' . $entryitem->id_order_data )}}" class="btn btn-info btn-xs"><b>DETAIL</b></a></td>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Jam - Tanggal</th>
                      <th>Order ID</th>
                      <th>Pallet ID</th>
                      <th>Total Barang</th>
                      <th>SATKER</th>
                      <th>Aksi</th>
                    </tr> 
                    </tfoot>
                </table>
            </div>
            <!-- Riwayat -->
            <div class="tab-pane fade" id="custom-content-below-history" role="tabpanel" aria-labelledby="custom-content-below-history-tab">
                <b><h5>{{ $data->id_slot }} - Riwayat Barang  Masuk & Keluar</h5></b>
                <br>
                <table id="example2b" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Order ID</th>
                      <th>Nama Barang</th>
                      <th>Jumlah Barang</th>
                      <th>SATKER</th>
                      <th>Jam/Tgl Masuk</th>
                      <th>Jam/Tgl Keluar</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                    @foreach($rack_history as $history)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $history->order_id }}</td>
                      <td>{{ $history->item_name }}</td>
                      <td>{{ $history->item_qty }}</td>
                      <td>{{ $history->workunit_name }}</td>
                      <td>{{ date('H:i', strtotime($history->item_entry_date)) }} / 
                          {{ date('d F Y', strtotime($history->item_entry_date)) }}</td>
                      <td>
                          @if($history->item_exit_date == '')
                            <b> - </b>
                          @endif
                          @if($history->item_exit_date != '')
                            {{ date('H:i', strtotime($history->item_exit_date)) }} / 
                            {{ date('d F Y', strtotime($history->item_exit_date)) }}
                          @endif
                      </td>
                      <td class="td-status">
                        @if($history->item_status == 'Barang Masuk')
                          <a class="btn btn-success btn-xs disabled">BARANG MASUK</span>
                        @endif
                        @if($history->item_status == 'Barang Keluar')
                          <a class="btn btn-danger btn-xs disabled">BARANG KELUAR</span>
                        @endif
                      </td>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Order ID</th>
                      <th>Nama Barang</th>
                      <th>Jumlah Barang</th>
                      <th>SATKER</th>
                      <th>Tanggal Masuk</th>
                      <th>Tanggal Keluar</th>
                      <th>Status</th>
                    </tr> 
                    </tfoot>
                </table>
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.card -->
    </div>
  </section>
  @endif
  @endforeach


@endsection