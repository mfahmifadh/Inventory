@extends('v_admin_master.layout.app')

@section('content')
    @foreach($order as $data)
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <div class="row">
              <h1 class="m-0"><a href="javascript:window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i>
              </a></h1>
              &nbsp;
              <h1 class="m-0"><a href="{{ url('admin-master/download_pdf/'. $data->id_order) }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i>
              </a></h1>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


  
  <section class="content">
      <div class="container-fluid">
        <br>
        <table class="table table-borderless" style="background-color: white;">
          <thead>
                <tr class="header-confirm">
                  <td><center><img src="{{ asset('assets/img/kemenkes.png' )}}" width="100" height="100"></center></td>
                  <td class="header-text-confirm">
                  <center>
                    <font size="5"><b>KEMENTRIAN KESEHATAN REPUBLIK INDONESIA</b></font><br>
                    <font size="4">BIRO UMUM RUMAH TANGGA SEKRETARIAT JENDRAL</font><br>
                    <font size="2"><i>Jl. H.R. Rasuna Said Blok X.5 Kav. 4-9, Blok A, 2nd Floor, Jakarta 12950<br>Telp.: (62-21) 5201587, 5201591 Fax. (62-21) 5201591</i></font>
                  </center>
                  </td>
                  <td><center><img src="{{ asset('assets/img/germas.png' )}}" width="100" height="100"></center></td>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td class="confirm-txt-tanggal" colspan="3">{{ date('d F Y', strtotime($data->order_dt)) }}</td>
              </tr> 
              <tr>
                <td>Nomor</td>
                <td colspan="2"> : {{ $data->letter_num }} </td>
              </tr>
              <tr>
                <td>Perihal</td>
                <td colspan="2"> : {{ $data->order_category }} Barang</td>
              </tr>
              <tr>
                <td style="padding-top:5vh;" colspan="3">
                  Bersama dengan surat ini, Satuan Kerja <b>{{ $data->workunit_name }}</b> telah melakukan <b> {{ $data->order_category }} Barang</b>, dengan data barang sebagai berikut : <br><br>
                  <table class="table table-bordered">
                    <tr>
                      <th>No</th>
                      <th>Kategori Barang</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>ID Pallet</th>
                      <th>Gudang</th>
                    </tr>
                    <?php $no=1;?>
                    @foreach($dataitem as $row)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $row->itemcategory_name }}</td>
                      <td>{{ $row->item_name }}</td>
                      <td>{{ $row->item_qty }}</td>
                      <td>{{ $row->slot_id }}</td>
                      <td>{{ $row->warehouse_name }}</td>
                    @endforeach
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">Jakarta, {{ date('d F Y', strtotime($data->order_dt)) }}</td>
              </tr>
              <tr>
                <td><b>PETUGAS</b></td>
                <td style="padding-left: 10vh;"><b>SATUAN KERJA</b></td>
              </tr>
              <tr >
                <td style="padding-top:10vh;text-transform: uppercase;">
                  <p style="border-bottom: solid;"></p>{{ $data->full_name }}<br> <!-- ({{ $data->id }}) --></td>
                <td style="padding-left: 10vh;padding-top:10vh;">
                  <p style="border-bottom: solid;width: 10vh;"></p>{{ $data->workunit_name }}<br> <!-- ({{ $data->id }}) --></td>
              </tr>
            </tbody>
            
        </table>
      </div>
  </section>
  <br>





    @endforeach

@endsection