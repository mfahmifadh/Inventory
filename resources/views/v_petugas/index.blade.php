@extends('v_petugas.layout.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
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
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color:#008000;color: white;">
              <div class="inner">
                <h4><b>Gudang 09</b></h4>
                <p><h6>{{ $palletavail09 }} PALLET TERSEDIA</h6></p>
              </div>
              <div class="icon">
                <i class="fas fa-pallet" style="color:#f8f8ff;"></i>
              </div>
              <a href="{{ url('admin-user/detail_warehouse/G09') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color:#008000;color: white;">
              <div class="inner">
                <h4><b>Gudang 05 B</b></h4>
                <p><h6>{{ $palletavail05b }} PALLET TERSEDIA</h6></p>
              </div>
              <div class="icon">
                <i class="fas fa-bars" style="color:#f8f8ff;"></i>
              </div>
              <a href="{{ url('admin-user/detail_warehouse/G05B') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- <div class="col-md-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">SOP PETUGAS</h3>
                        </div>
                        <div class="card-body" style="text-align: justify;">
                            <p>1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            <p>2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-4" style="text-transform:uppercase;">
                    <!-- Info Boxes Style 2 -->
                    <div class="card" style="background-color:#0EA2F6;color: white;">
                        <div class="card-header">
                            <h3 class="card-title">
                                <b>Bulan {{$month_now}}</b>
                            </h3>
                        </div>
                    </div>
                    <div class="info-box mb-3" style="background-color:#0EA2F6;color: white;">
                      <span class="info-box-icon"><i class="fas fa-boxes"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text"><b>TOTAL PENGIRIMAN BARANG</b></span>
                        <span class="info-box-number">{{ $totentryitem }} Pengiriman Barang Masuk</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <div class="info-box mb-3" style="background-color:#F65151;color: white;">
                      <span class="info-box-icon"><i class="fas fa-boxes"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text"><b>TOTAL PENGAMBILAN BARANG</b></span>
                        <span class="info-box-number">{{ $totexititem }} Pengambilan Barang Keluar</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card" >
                        <div class="card-header" style="background-color:#0EA2F6;color: white;">
                            <h3 class="card-title">
                                <b>DATA BARANG MASUK</b>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example2c" class="table table-bordered table-striped">
                                <thead>
                                    <tr style="font-size:15px;text-align: center;">
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>DEADLINE</th>
                                        <th>SATKER</th>
                                        <th>TOTAL BARANG</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach($endorders as $orders)
                                        <tr class="td-status">
                                            <td><a href="{{ url('admin-user/detail_order/'. $orders->id_order) }}"><b>{{$no++}}</b></a></td>
                                            <td>{{ \Carbon\Carbon::parse($orders->order_dt)->isoFormat('DD MMM Y') }}</td>
                                            <td>
                                                @if($orders->order_deadline <= $datenow)
                                                <button class="btn btn-danger btn-sm disabled">
                                                    {{ \Carbon\Carbon::parse($orders->order_deadline)->isoFormat('DD MMM Y') }}
                                                </button>
                                                @endif
                                                @if($orders->order_deadline > $datenow)
                                                <button class="btn btn-warning btn-sm disabled"><b>
                                                    {{ \Carbon\Carbon::parse($orders->order_deadline)->isoFormat('DD MMM Y') }}
                                                </b></button>
                                                @endif
                                                
                                            </td>
                                            <td>{{$orders->workunit_name}}</td>
                                            <td>{{$orders->totalitem}} Barang</td>
                                            <td class="td-status">
                                                @if($orders->order_category == 'Pengiriman')
                                                <a class="btn btn-success btn-sm disabled"><b>Barang Masuk</b></a>
                                                @endif
                                                @if($orders->order_category == 'Pengambilan')
                                                <a class="btn btn-danger btn-sm disabled">Barang Keluar</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr style="font-size:15px;text-align: center">
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>DEADLINE</th>
                                        <th>SATKER</th>
                                        <th>TOTAL BARANG</th>
                                        <th>STATUS</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                <b>DATA BARANG MASUK</b>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example2d" class="table table-bordered table-striped">
                                <thead>
                                    <tr style="font-size:15px;text-align: center;">
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>SATKER</th>
                                        <th>TOTAL BARANG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $exno=1; ?>
                                    @foreach($enorders as $enorders)
                                    <tr class="td-status">
                                        <td><a href="{{ url('admin-user/detail_order/'. $enorders->id_order) }}"><b>{{$exno++}}</b></a></td>
                                        <td>{{ \Carbon\Carbon::parse($enorders->order_dt)->isoFormat('DD MMM Y') }}</td>
                                        <td>{{$enorders->workunit_name}}</td>
                                        <td>{{$enorders->totalitem}} Barang</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr style="font-size:15px;text-align: center">
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>SATKER</th>
                                        <th>TOTAL BARANG</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" style="background-color:#F65151;color: white;">
                            <h3 class="card-title">
                                <b>DATA BARANG KELUAR</b>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example2b" class="table table-bordered table-striped">
                                <thead>
                                    <tr style="font-size:15px;text-align: center;">
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>SATKER</th>
                                        <th>TOTAL BARANG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $exno=1; ?>
                                    @foreach($exorders as $exorders)
                                    <tr class="td-status">
                                        <td><a href="{{ url('admin-user/detail_order/'. $exorders->id_order) }}"><b>{{$exno++}}</b></a></td>
                                        <td>{{ \Carbon\Carbon::parse($exorders->order_dt)->isoFormat('DD MMM Y') }}</td>
                                        <td>{{$exorders->workunit_name}}</td>
                                        <td>{{$exorders->totalitem}} Barang</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr style="font-size:15px;text-align: center">
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>SATKER</th>
                                        <th>TOTAL BARANG</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-warning">   
          <div class="card-header">
                <h3 class="card-title" style="float:left;margin-top: 0.5vh;">
                    <b>DATA GUDANG AKTIF</b>
                </h3>
          </div>
          <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-content-below-entryitem-tab" data-toggle="pill" href="#custom-content-below-entryitem" role="tab" aria-controls="custom-content-below-entryitem" aria-selected="true"><b>Gudang 09</b></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-content-below-exititem-tab" data-toggle="pill" href="#custom-content-below-exititem" role="tab" aria-controls="custom-content-below-exititem" aria-selected="false"><b>Gudang 05B</b></a>
            </li>
          </ul>
          <div class="card-body" >
            <div class="tab-content" id="custom-content-below-tabContent">
              <!-- Barang Masuk -->
              <div class="tab-pane fade show active" id="custom-content-below-entryitem" role="tabpanel" aria-labelledby="custom-content-below-entryitem-tab">
                @foreach($warehouse09 as $warehouse09)
                @if($warehouse09->id_warehouse == 'G09')
                  <div class="row"> 
                      @foreach($pallet as $row)
                          @if($row->slot_status == 'Tersedia' && $row->pallet_id != '0')
                              <div class="col-xs-1-5" style="margin-bottom:3vh;">
                                  <a href="{{ url('admin-user/detail_slot/'. $row->id_slot) }}" class="btn btn-success">
                                      {{ $row->pallet_name }}</a>
                              </div>

                          @endif
                          @if($row->slot_status == 'Penuh' && $row->pallet_id != '0')
                              <div class="col-xs-1-5" style="margin-bottom:3vh;">
                                  <a href="{{ url('admin-user/detail_slot/'. $row->id_slot) }}" class="btn btn-danger">
                                      {{ $row->pallet_name }}</a>
                              </div>
                          @endif
                          @if($row->pallet_id == '0')
                              <div class="col-xs-1-6" style="margin-bottom:3vh;">
                                  <a href="" class="btn btn-warning disabled">JALUR MANUAL FORKLIFT</a>
                              </div>
                          @endif
                      @endforeach
                  </div>
                @endif
                @endforeach
              </div>
              <!-- Barang Keluar -->
              <div class="tab-pane fade" id="custom-content-below-exititem" role="tabpanel" aria-labelledby="custom-content-below-exititem-tab">
                <hr>
                <p>Kode Rak : <b>I</b></p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <b>Tingkat 1</b>
                        <hr>
                        <div class="row" >
                            @foreach($rack_pallet_one_lvl1 as $row)
                                @if($row->slot_status == 'Tersedia')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Tingkat 2</b>
                        <hr>
                        <div class="row" >
                            @foreach($rack_pallet_one_lvl2 as $row)
                                @if($row->slot_status == 'Tersedia')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr>
                <p>Kode Rak : <b>II</b></p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <b>Tingkat 1</b>
                        <hr>
                        <div class="row" >
                            @foreach($rack_pallet_two_lvl1 as $row)
                                @if($row->slot_status == 'Tersedia')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Tingkat 2</b>
                        <hr>
                        <div class="row" >
                            @foreach($rack_pallet_two_lvl2 as $row)
                                @if($row->slot_status == 'Tersedia')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr>
                <p>Kode Rak : <b>III</b></p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <b>Tingkat 1</b>
                        <hr>
                        <div class="row" >
                            @foreach($rack_pallet_three_lvl1 as $row)
                                @if($row->slot_status == 'Tersedia')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Tingkat 2</b>
                        <hr>
                        <div class="row" >
                            @foreach($rack_pallet_three_lvl2 as $row)
                                @if($row->slot_status == 'Tersedia')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr>
                <p>Kode Rak : <b>IV</b></p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <b>Tingkat 1</b>
                        <hr>
                        <div class="row" >
                            @foreach($rack_pallet_four_lvl1 as $row)
                                @if($row->slot_status == 'Tersedia')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Tingkat 2</b>
                        <hr>
                        <div class="row" >
                            @foreach($rack_pallet_four_lvl2 as $row)
                                @if($row->slot_status == 'Tersedia')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-user/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>



@endsection