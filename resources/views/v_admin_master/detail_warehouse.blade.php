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
              <li class="breadcrumb-item active">Detail Gudang {{ $data->id_warehouse }}</li>
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
        <!-- Detail Slot Palleting -->
        @if($data->warehouse_category == 'Palleting')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float:left;margin-top: 0.5vh;">Gudang {{ $data->id_warehouse }}</h3>
                <h3 class="card-title" id="card-title-right">
                    <a href="{{ url('admin-master/create_slot/'. $data->id_warehouse) }}" class="btn btn-primary btn-sm">
                        Tambah Slot
                    </a>
                    <!-- <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-pallet">
                        Ubah Data Slot
                    </a> -->
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if($data->id_warehouse == 'G09')
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
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        @endif

        <!-- Detail Slot Racking -->
        @if($data->warehouse_category == 'Racking')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float:left;margin-top: 0.5vh;">Gudang {{ $data->id_warehouse }}</h3>
                <h3 class="card-title" style="float:right;">
                    <a href="{{ url('admin-master/create_slot/'. $data->id_warehouse) }}" class="btn btn-primary btn-sm">
                        Tambah Slot
                    </a>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        @endif

        <div class="modal fade" id="modal-edit-pallet">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Slot</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                              <label>Nama Gudang : </label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                                </div>
                                <input type="text" class="form-control" name="warehouse_id" value="{{ $data->id_warehouse }}" readonly>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label>Pilih Kode Pallet : </label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <select class="form-control">
                                    <option>-- Pilih Kode Pallet --</option>
                                    @foreach($slot as $row)
                                    <option value="{{ $row->id_slot }}">{{ $row->id_slot }}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label>Kode Pallet Baru : </label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" name="id_slot" placeholder="Masukan Kode baru">
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

      </div>
  </section>
  @endforeach



@endsection