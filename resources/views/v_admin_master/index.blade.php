@extends('v_admin_master.layout.app')

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
            <div class="small-box bg-info">
              <div class="inner">
                <h4><b>GUDANG 09</b></h4>
                <p><h6>{{ $palletavail09 }} Pallet Tersedia</h6></p>
              </div>
              <div class="icon">
                <i class="fas fa-pallet"></i>
              </div>
              <a href="{{ url('admin-master/detail_warehouse/G09') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4><b>GUDANG 05 B</b></h4>
                <p><h6>{{ $palletavail05b }} Pallet Tersedia</h6></p>
              </div>
              <div class="icon">
                <i class="fas fa-pallet"></i>
              </div>
              <a href="{{ url('admin-master/detail_warehouse/G05B') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
    </section>

    <!-- Chart Content -->
<!--     <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <div class="card-title"><b>GRAFIK BARANG MASUK & KELUAR</b></div>
                        </div>
                        <div class="card-body">
                            <canvas id="barChart" style="height:62vh;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Warehouse content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">   
          <div class="card-header">
              <h3 class="card-title left" style="float:left;margin-top: 0.5vh;">Data Gudang Aktif</h3>
          </div>
          <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-content-below-entryitem-tab" data-toggle="pill" href="#custom-content-below-entryitem" role="tab" aria-controls="custom-content-below-entryitem" aria-selected="true">Gudang 09</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-content-below-exititem-tab" data-toggle="pill" href="#custom-content-below-exititem" role="tab" aria-controls="custom-content-below-exititem" aria-selected="false">Gudang 05B</a>
            </li>
          </ul>
          <div class="card-body">
            <div class="tab-content" id="custom-content-below-tabContent">
              <!-- Barang Masuk -->
              <div class="tab-pane fade show active" id="custom-content-below-entryitem" role="tabpanel" aria-labelledby="custom-content-below-entryitem-tab">
                @foreach($warehouse09 as $warehouse09)
                @if($warehouse09->id_warehouse == 'G09')
                  <div class="row"> 
                      @foreach($pallet as $row)
                          @if($row->slot_status == 'Tersedia' && $row->pallet_id != '0')
                              <div class="col-xs-1-5" style="margin-bottom:3vh;">
                                  <a href="{{ url('admin-master/detail_slot/'. $row->id_slot) }}" class="btn btn-success">
                                      {{ $row->pallet_name }}</a>
                              </div>

                          @endif
                          @if($row->slot_status == 'Penuh' && $row->pallet_id != '0')
                              <div class="col-xs-1-5" style="margin-bottom:3vh;">
                                  <a href="{{ url('admin-master/detail_slot/'. $row->id_slot) }}" class="btn btn-danger">
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
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
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
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
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
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
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
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
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
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
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
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
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
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
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
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-success" style="width:100%;">{{ $row->id_slot }}</a>
                                    </div>

                                @endif
                                @if($row->slot_status == 'Penuh')
                                    <div class="col-md-4" style="margin-bottom:5vh;">
                                        <a href="{{ url('admin-master/detail_slot/'. $row->id_slot)}}" class="btn btn-danger" style="width:100%;">{{ $row->id_slot }}</a>
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
  </section>



@endsection