@extends('v_satker.layout.app')

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
              <li class="breadcrumb-item"><a href="{{ url('satker/dashboard') }}">Dashboard</a></li>
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
                    <h6>Tanggal Masuk <span style="margin-right:4vh;"></span>: 
                      <b>{{ \Carbon\Carbon::parse($palletorderid->order_dt)->isoFormat('DD MMMM Y') }}</b>
                    </h6>
                  </div>
                  <div class="col-md-9">
                    <h6>Satuan Kerja <span style="margin-right:4vh;"></span>:
                      <b>{{ $palletorderid->workunit_name }}</b></h6>
                  </div>
                  <div class="col-md-3">
                    <h6>Tanggal Deadline <span style="margin-right:2vh;"></span>: 
                      <b>{{ \Carbon\Carbon::parse($palletorderid->order_deadline)->isoFormat('DD MMMM Y') }}</b>
                    </h6>
                  </div>
                </div>
                @endforeach
                <br>
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
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
              <li class="breadcrumb-item"><a href="{{ url('satker/dashboard') }}">Dashboard</a></li>
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
            <a class="nav-link active" id="custom-content-below-entryitem-tab" data-toggle="pill" href="#custom-content-below-entryitem" role="tab" aria-controls="custom-content-below-entryitem" aria-selected="true">Barang Masuk</a>
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
                    <h6>Tanggal Masuk <span style="margin-right:4vh;"></span>: 
                      <b>{{ \Carbon\Carbon::parse($palletorderid->order_dt)->isoFormat('DD MMMM Y') }}</b>
                    </h6>
                  </div>
                  <div class="col-md-9">
                    <h6>Satuan Kerja <span style="margin-right:4vh;"></span>:
                      <b>{{ $palletorderid->workunit_name }}</b></h6>
                  </div>
                  <div class="col-md-3">
                    <h6>Tanggal Deadline <span style="margin-right:2vh;"></span>: 
                      <b>{{ \Carbon\Carbon::parse($palletorderid->order_deadline)->isoFormat('DD MMMM Y') }}</b>
                    </h6>
                  </div>
                </div>
                @endforeach
                <br>
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                     <th>No</th>
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