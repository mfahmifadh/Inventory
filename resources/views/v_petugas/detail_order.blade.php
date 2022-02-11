@extends('v_petugas.layout.app')

@section('content')


  @foreach($orders as $data)
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin-user/dashboard') }}">Dashboard</a></li>
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
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><b>ID ORDER ({{$data->id_order}}) - DATA BARANG</b></h3>  
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-content-below-tabContent">
              <!-- Barang Masuk -->
              <div class="tab-pane fade show active" id="custom-content-below-entryitem" role="tabpanel" aria-labelledby="custom-content-below-entryitem-tab">
                <div class="row">
                  <div class="col-md-9">
                    <h6>Kode Pengiriman : 
                      <b>{{ $data->id_order }}</b>
                    </h6>
                  </div>
                  @if($data->order_category == 'Pengiriman')
                  <div class="col-md-3">
                    <h6>Tanggal Masuk <span style="margin-right:4vh;"></span>: <b>{{ \Carbon\Carbon::parse($data->order_dt)->isoFormat('DD MMMM Y') }}</b></h6>
                  </div>
                  <div class="col-md-9">
                    <h6>Satuan Kerja <span style="margin-right:4vh;"></span>:
                      <b>{{ $data->workunit_name }}</b></h6>
                  </div>
                  <div class="col-md-3">
                    <h6>Tanggal Deadline <span style="margin-right:2vh;"></span>:
                        <b>{{ \Carbon\Carbon::parse($data->order_deadline   )->isoFormat('DD MMMM Y') }}</b></h6>
                  </div>
                  @endif
                  @if($data->order_category == 'Pengambilan')
                  <div class="col-md-3">
                    <h6>Tanggal Pengambilan : <span style="margin-right: -1vh;"></span>: <b>{{ \Carbon\Carbon::parse($data->order_dt)->isoFormat('DD MMMM Y') }}</b></h6>
                  </div>
                  <div class="col-md-9">
                    <h6>Satuan Kerja <span style="margin-right:4vh;"></span>:
                      <b>{{ $data->workunit_name }}</b></h6>
                  </div>
                  @endif
                </div>
                <br>
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Gudang</th>
                      <th>ID Slot</th>
                      <th>Nama Barang</th>
                      <th>Tinggi</th>
                      <th>Berat</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                    @foreach($items as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->warehouse_name }}</td>
                        <td>{{ $row->slot_id }}</td>
                        <td>{{ $row->item_name }}</td>
                        <td>{{ $row->item_height }}</td>
                        <td>{{ $row->item_weight }}</td>
                        <td>{{ $row->item_qty }}</td>
                        <td>{{ $row->description }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Gudang</th>
                      <th>ID Slot</th>
                      <th>Nama Barang</th>
                      <th>Tinggi</th>
                      <th>Berat</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>
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
  @endforeach

@endsection