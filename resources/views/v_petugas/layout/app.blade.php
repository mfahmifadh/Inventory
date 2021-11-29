<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>INVENTORY | KEMENKES</title>
  <link rel="icon" href="{{ asset('assets/img/logo-ebuilding-1a.jpg') }}"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}">
  <!-- Data Tables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('assets/img/KemenkesLogo.png') }}" alt="Biro Umum KEMENKES" width="20%">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('signout') }}">
            <i class="fas fa-sign-out-alt" title="Keluar">Keluar</i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4" >
      <!-- Brand Logo -->
      <a href="{{ url('admin-user/dashboard') }}" class="brand-link">
        <center><img class="animation__shake img-responsive" src="{{ asset('assets/img/KemenkesLogo2Brown.png') }}" alt="Biro Umum KEMENKES" class="brand-image img-circle elevation-3" style="opacity: .8" width="70%"></center>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('assets/img/AdminLTELogo.png') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="{{ url('admin-user/show_profile/'. Auth::id()) }}" class="d-block" style="margin-top: 0.3vh;text-transform: uppercase;"><b>{{ Auth::user()->full_name }}</b></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{ url('admin-user/dashboard') }}" class="nav-link {{ Request::is('admin-user/dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('admin-user/show_warehouse') }}" class="nav-link {{ Request::is('admin-user/show_warehouse') ? 'active' : '' }}">
                <i class="nav-icon fas fa-warehouse"></i>
                <p>
                  Data Gudang
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-box-open"></i>
                <p>
                  Data Barang
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin-user/category_item/') }}" class="nav-link">
                    <i class="fas fa-list nav-icon"></i>
                    <p>Kategori Barang</p>
                  </a>
                </li>
              </ul>
            </li> 
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-people-carry"></i>
                <p>
                  Proses Barang
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin-user/create_all_order/') }}" class="nav-link">
                    <i class="fas fa-chevron-circle-right"></i>
                    <p>Proses Barang Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin-user/create_exit_order/') }}" class="nav-link">
                    <i class="fas fa-chevron-circle-left"></i>
                    <p>Proses Barang Keluar</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ url('admin-user/show_history') }}" class="nav-link {{ Request::is('admin-user/show_history') ? 'active' : '' }}">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  Riwayat
                </p>
              </a>
            </li> 
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <main>
      <div class="content-wrapper">
        @yield('content')
      </div>
    </main>

      
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="#">mfahmifadh</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('assets/js/adminlte.js') }}"></script>
  <!-- Chart -->
  <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Data Tables -->
  <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script>
    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    $(function () {
      var i = 0;   
      var j = 0;
      var k = 0;
      let cekslotid;
      let data = [];
      let barang = [];

      // =========================================
      // MENAMBAH SECTION BARU 
      // =========================================
      $("#add-more-pallet").click(function () {
        ++i;
        ++j;
        ++k;
        $.ajax({
            type:"GET",
            url:"/admin-user/get_item_category",
            dataType: 'JSON',
            success:function(res){
              let option = "";
              $.each(res,function(itemcategory_name,id_item_category){
                  option += '<option value='+id_item_category+'>'+ itemcategory_name+ '</option>'
              });
                $(".add-more-pallet").append(
                  '<div class="more">' +
                  '<p style="background-color:#F7882F;width:100%;height:6vh;padding-top:0.8%;padding-left:1%;margin:2vh 0vh 2vh 0vh;color:white;border-radius:4px;font-size:2.3vh;"><b>TAMBAH DATA BARANG MASUK '+k+'</b></p>' +
                    '<div class="row">' +
                      '<div class="col-md-6">' + 
                        '<label>PILIH GUDANG : </label>' +
                        '<div class="input-group mb-3">' +
                          '<div class="input-group-prepend">' +
                            '<span class="input-group-text"><i class="fas fa-warehouse"></i></span>' +
                          '</div>' +
                          '<select class="form-control warehouse2" data-idtarget="'+i+'" required>' +
                            '<option value="">-- PILIH GUDANG --</option>' +
                            '<option value="G05B">GUDANG 05 B</option>' +
                            '<option value="G09">GUDANG 09</option>' +
                          '</select>' +
                        '</div>' +
                      '</div>' +
                      '<div class="col-md-5">' + 
                        '<label>PILIH PALLET : </label>' +
                        '<div class="input-group mb-3">' +
                          '<div class="input-group-prepend">' +
                            '<span class="input-group-text"><i class="fas fa-pallet"></i></span>' +
                          '</div>' +
                          '<select id="slot_id'+i+'" class="form-control slot_iden" name="slot_id['+i+']" data-idtarget="'+i+'" required><option value="">-- PILIH PALLET --</option></select>' +
                        '</div>' +
                      '</div>' +
                      '<div class="col-md-1">' + 
                        '<label>&nbsp;</label>' +
                        '<div class="input-group mb-3">' +
                          '<a class="remove-pallet form-control btn btn-danger"><i class="fas fa-trash"></i></a>' +
                        '</div>' +
                      '</div>' +
                    '</div><hr>' +

                  '<table class="table table-bordered table-striped add-more'+i+'">' +
                    '<thead><tr>' +
                      '<th>Kategori Barang</th>' +
                      '<th>Nama Barang</th>' +
                      '<th>Berat</th>' +
                      '<th>Tinggi</th>' +
                      '<th>Jumlah</th>' +
                      '<th>Keterangan</th>' +
                      '<th>Aksi</th>' +
                      '</tr></thead>' +
                    '<tbody><tr>' +
                      '<input type="hidden" name="id_order_data['+i+']" value="PBM-{{ $idorderdata }}'+j+'">' +
                      '<td><select class="form-control" name="itemcategory_id['+i+']" required><option value="">-- Pilih Ketegori --</option>'+option+'</select></td>' +
                      '<td><input type="text" name="item_name['+i+']" class="form-control" placeholder="Nama Barang" required</td>' +
                      '<td><input type="text" name="item_weight['+i+']" class="form-control" placeholder="Contoh : 200 kg" required></td>' +
                      '<td><input type="text" name="item_height['+i+']" class="form-control" placeholder="Contoh : 200 cm" required></td>' +
                      '<td><input type="number" name="item_qty['+i+']" class="form-control" placeholder="Contoh : 200 " required></td>' +
                      '<td><input type="text" name="description['+i+']" class="form-control" placeholder="Keterangan Barang"></td>' +
                      '<td align="center">' +
                        '<a class="btn btn-primary btn-md add-more-item2" data-idtarget2="'+i+'"><i class="fas fa-plus-square"></i></a>' +
                        '<input type="hidden" name="order_data_id['+i+']" value="PBM-{{ $idorderdata }}'+j+'">'+
                      '</td>' +
                    '</tbody>' +
                  '</table>' +

                  '</div>'
                );
            }
        });
        
      });

      // =========================================
      // MENAMBAH SECTION BARU UNTUK BARANG KELUAR
      // =========================================

      $("#exit-add-more-pallet").click(function () {
        ++i;
        ++j;
        ++k;
        let satkerid = $('#exitsatker').val();
        $.ajax({
            type:"GET",
            url:"/admin-user/get_warehouse_id?satkerid="+satkerid,
            dataType: 'JSON',
            success:function(res){
              let option = "";
              $.each(res,function(id_warehouse,warehouse_name){
                  option += '<option value='+id_warehouse+'>'+ warehouse_name+ '</option>'
              });
                $(".add-more-pallet").append(
                  '<div class="more">' +
                    '<p style="background-color:#F7882F;width:100%;height:6vh;padding-top:0.8%;padding-left:1%;margin:2vh 0vh 2vh 0vh;color:white;border-radius:4px;font-size:2.3vh;"><b>TAMBAH DATA BARANG KELUAR '+k+'</b></p>' +
                    '<div class="row">' +
                      '<div class="col-md-6">' + 
                        '<label>PILIH GUDANG : </label>' +
                        '<div class="input-group mb-3">' +
                          '<div class="input-group-prepend">' +
                            '<span class="input-group-text"><i class="fas fa-warehouse"></i></span>' +
                          '</div>' +
                          '<select class="form-control exitwarehouse2" data-idtarget="'+i+'" required>' +
                            '<option value="">-- PILIH GUDANG --</option>'+ option +'' +
                          '</select>' +
                        '</div>' +
                      '</div>' +
                      '<div class="col-md-5">' + 
                        '<label>PILIH PALLET : </label>' +
                        '<div class="input-group mb-3">' +
                          '<div class="input-group-prepend">' +
                            '<span class="input-group-text"><i class="fas fa-pallet"></i></span>' +
                          '</div>' +
                          '<select class="form-control exitpallet2 setorderdataid2 slot_idex" id="ep2'+i+'" data-idtarget2="'+i+'" name="slot_id['+i+']" required><option value="">-- PILIH PALLET --</option></select>' +
                        '</div>' +
                      '</div>' +
                      '<span id="getorderdataid'+i+'"></span>' +
                      '<div class="col-md-1">' + 
                        '<label>&nbsp;</label>' +
                        '<div class="input-group mb-3">' +
                          '<a class="remove-pallet form-control btn btn-danger"><i class="fas fa-trash"></i></a>' +
                        '</div>' +
                      '</div>' +
                    '</div><hr>' +

                    '<table class="table table-bordered table-striped add-more'+i+'">' +
                      '<thead><tr>' +
                        '<th>Barang</th>' +
                        '<th>Kategori Barang</th>' +
                        '<th>Berat</th>' +
                        '<th>Tinggi</th>' +
                        '<th>Jumlah</th>' +
                        '<th>Keterangan</th>' +
                        '<th>Aksi</th>' +
                        '</tr></thead>' +
                      '<tbody><tr>' +
                        '<input type="hidden" name="id_order_data['+i+']" value="PBK-{{ $idorderdata }}'+j+'">' +
                        '<td><select class="form-control itemname2 itemcode" id="getitm'+i+'" data-idtarget="'+i+'" name="item_code['+i+']" required><option value="">-- Pilih Barang --</option></select></td>' +
                        '<td><span id="itemcategory'+i+'"></span></td>' +
                        '<td><span id="itemname'+i+'"></span></td></td>' +
                        '<td><span id="itemweight'+i+'"></span></td></td>' +
                        '<td><span id="itemheight'+i+'"></span></td></td>' +
                        '<td><span id="itemqty'+i+'"></span></td></td>' +
                        '<td><span id="itemdescription'+i+'"></span></td></td>' +
                        '<td align="center">' +
                          '<a class="btn btn-primary btn-md exit-add-more-item2" data-idtarget2="'+i+'"><i class="fas fa-plus-square"></i></a>' +
                          '<input type="hidden" name="order_data_id['+i+']" value="PBK-{{ $idorderdata }}'+j+'">'+
                        '</td>' +
                      '</tbody>' +
                    '</table>' +
                  '</div>'
                );
            }
        });
        
      });

      // =========================================
      // MENAMBAH ROW BARU UNTUK INDEX 0
      // =========================================

      $("#add-more-item").click(function () {
        ++i;
        $.ajax({
            type:"GET",
            url:"/admin-user/get_item_category",
            dataType: 'JSON',
            success:function(res){
              let option = "";
              $.each(res,function(itemcategory_name,id_item_category){
                  option += '<option value='+id_item_category+'>'+ itemcategory_name+ '</option>'
              });
                $(".add-more").append(
                  '<tr><td><select class="form-control" name="itemcategory_id['+i+']" required><option value="">-- Pilih Ketegori --</option>'+option+'</select></td><td><input type="text" name="item_name['+i+']" class="form-control" placeholder="Nama Barang" required</td><td><input type="text" name="item_weight['+i+']" class="form-control" placeholder="Contoh : 200 kg" required></td><td><input type="text" name="item_height['+i+']" class="form-control" placeholder="Contoh : 200 cm" required></td><td><input type="number" name="item_qty['+i+']" class="form-control" placeholder="Contoh : 200 " required></td><td><input type="text" name="description['+i+']" class="form-control" placeholder="Keterangan Barang"></td><td align="center"><a type="button" class="remove-item btn btn-danger btn-md"><i class="fas fa-trash-alt"></i></a><input type="hidden" name="order_data_id['+i+']" value="PBM-{{ $idorderdata }}0"></td></tr>'
                );
            }
        });
        
      }); 

      // ===================================================
      // MENAMBAH ROW BARU UNTUK INDEX 0 UNTUK BARANG KELUAR
      // ===================================================


      $(document).on('change', '.itemcode', function(){
          barang      = $('.itemcode').map(function() { return this.value }).get();
          console.log(barang);
      });

      $("#exit-add-more-item").click(function () {
        ++i;
        let slotid = $('#exitpallet').val();
        $.ajax({
            type:"GET",
            url:"/admin-user/get_item_id_not_in?slotid="+slotid,
            data:{"data":barang},
            dataType: 'JSON',
            success:function(res){
              let option = "";
              $.each(res,function(item_code,item_name){
                  option += '<option value='+item_code+'>'+ item_name+ '</option>'
              });
                $(".add-more").append(
                  '<tr>' +
                  '<td><select class="form-control itemname2 itemcode" data-idtarget="'+i+'" name="item_code['+i+']" required><option value="">-- Pilih Barang --</option>'+ option +'</select></td>' +
                  '<td><span id="itemcategory'+i+'"></td>' +
                  '<td><span id="itemname'+i+'"></td>' +
                  '<td><span id="itemweight'+i+'"></td>' +
                  '<td><span id="itemheight'+i+'"></td>' +
                  '<td><span id="itemqty'+i+'"></td>' +
                  '<td><span id="itemdescription'+i+'"></td>' +
                  '<td align="center"><a type="button" class="remove-item btn btn-danger btn-md"><i class="fas fa-trash-alt"></i></a><input type="hidden" name="order_data_id['+i+']" value="PBK-{{ $idorderdata }}'+j+'"></td>' +
                  '</tr>'
                );
            }
        });
        
      });

      // =========================================
      // MENAMBAH ROW BARU UNTUK INDEX 1 DAN SETERUSNYA
      // =========================================

      $(document).on('click', '.add-more-item2', function(){
        i++;
        let idtarget2 = $(this).data('idtarget2');
        $.ajax({
            type:"GET",
            url:"/admin-user/get_item_category",
            dataType: 'JSON',
            success:function(res){
              let option = "";
              $.each(res,function(itemcategory_name,id_item_category){
                  option += '<option value='+id_item_category+'>'+ itemcategory_name+ '</option>'
              });
                $(".add-more" + idtarget2).append(
                  '<tr><td><select class="form-control" name="itemcategory_id['+i+']" required><option value="">-- Pilih Ketegori --</option>'+option+'</select></td><td><input type="text" name="item_name['+i+']" class="form-control" placeholder="Nama Barang" required</td><td><input type="text" name="item_weight['+i+']" class="form-control" placeholder="Contoh : 200 kg" required></td><td><input type="text" name="item_height['+i+']" class="form-control" placeholder="Contoh : 200 cm" required></td><td><input type="number" name="item_qty['+i+']" class="form-control" placeholder="Contoh : 200 " required></td><td><input type="text" name="description['+i+']" class="form-control" placeholder="Keterangan Barang"></td><td align="center"><a type="button" class="remove-item btn btn-danger btn-md"><i class="fas fa-trash-alt"></i></a><input type="hidden" name="order_data_id['+i+']" value="PBM-{{ $idorderdata }}'+j+'"></td></tr>'
                );
            }
        });
      }); 

      // ==================================================================
      // MENAMBAH ROW BARU UNTUK INDEX 1 DAN SETERUSNYA UNTUK BARANG KELUAR
      // ==================================================================

      $(document).on('click', '.exit-add-more-item2', function(){
        i++;
        let idtarget2 = $(this).data('idtarget2'); 
        var slotid = $('#ep2'+idtarget2+'').val(); 
        $.ajax({
            type:"GET",
            url:"/admin-user/get_item_id_not_in?slotid="+slotid,
            data:{"data":barang},
            dataType: 'JSON',
            success:function(res){
              let option = "";
              $.each(res,function(item_code,item_name){
                  option += '<option value='+item_code+'>'+ item_name+ '</option>'
              });
                $(".add-more" + idtarget2).append(
                  '<tr>' +
                  '<td><select class="form-control itemname2 itemcode" data-idtarget="'+i+'" name="item_code['+i+']" required><option value="">-- Pilih Barang --</option>'+ option +'</select></td>' +
                  '<td><span id="itemcategory'+i+'"></td>' +
                  '<td><span id="itemname'+i+'"></td>' +
                  '<td><span id="itemweight'+i+'"></td>' +
                  '<td><span id="itemheight'+i+'"></td>' +
                  '<td><span id="itemqty'+i+'"></td>' +
                  '<td><span id="itemdescription'+i+'"></td>' +
                  '<td align="center"><a type="button" class="remove-item btn btn-danger btn-md"><i class="fas fa-trash-alt"></i></a><input type="hidden" name="order_data_id['+i+']" value="PBK-{{ $idorderdata }}'+j+'"></td>' +
                  '</tr>'
                );
            }
        });
      });

      // =========================================
      // HAPUS ROW INDEX 0
      // =========================================

      $(document).on('click', '.remove-item', function () {
        $(this).parents('tr').remove();
      });      

      // =========================================
      // HAPUS ROW 1 =>
      // =========================================

      $(document).on('click', '.remove-pallet', function () {
        $(this).parents('.more').remove();
      });

      // Data Table
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "searching":false, "paging": false, "info": false,
        "buttons": ["print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $("#example2").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $("#example2a").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $("#example2b").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $('#example3').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      // Summernote
      $('.summernote').summernote({
        
      });

    
    });

  // ================================
  // MENAMPILKAN TINGKAT RACK
  // ================================

  $('#warehouse').change(function(){
      var warehouseid = $(this).val(); 
      if(warehouseid){
          $.ajax({
              type:"GET",
              url:"/admin-user/get_slot_id?warehouseid="+warehouseid,
              dataType: 'JSON',
              success:function(res){        
              if(res){
                  $("#slot_id").empty();
                  $("#slot_id").append('<option value="">-- Pilih Pallet --</option>');
                  $.each(res,function(id_slot,id_slot){
                      $("#slot_id").append(
                        '<option value="'+id_slot+'">'+id_slot+'</option>'
                      );
                  });
              }else{
                  $("#slot_id").empty();
              }
              }
          });
      }else{
              $("#slot_id").empty();
      }      
  });

  $(document).on('change', '.slot_iden', function(){
      data      = $('.slot_iden').map(function() { return this.value }).get();
      console.log(data);
  });

  $(document).on('change', '.slot_idex', function(){
      data      = $('.slot_idex').map(function() { return this.value }).get();
      console.log(data);
  });

  $(document).on('change', '.warehouse2', function(){
      var warehouseid = $(this).val(); 
      let idtarget  = $(this).data('idtarget');

      if(warehouseid){
          $.ajax({
              type:"GET",
              url:"/admin-user/get_slot_id_not_in?warehouseid="+warehouseid,
              data:{"data":data},
              dataType: 'JSON',
              success:function(res){             
              if(res){
                  $("#slot_id" + idtarget).empty();
                  $("#slot_id" + idtarget).append('<option>---Pilih Pallet---</option>');
                  $.each(res,function(id_slot,id_slot){
                      $("#slot_id" + idtarget).append(
                        '<option value="'+id_slot+'">'+id_slot+'</option>'
                      );
                  });
              }else{
                  $("#slot_id" + idtarget).empty();
              }
              }
          });
      }else{
              $("#slot_id" + idtarget).empty();
      }      
  }); 


  // ================================
  // MENAMPILKAN DATA BARANG KELUAR
  // ================================

  $('#exitsatker').change(function(){
      var satkerid = $(this).val(); 
      if(satkerid){
          $.ajax({
              type:"GET",
              url:"/admin-user/get_warehouse_id?satkerid="+satkerid,
              dataType: 'JSON',
              success:function(res){      
              if(res){
                  $("#exitwarehouse").empty();
                  $("#exitwarehouse").append('<option value="">-- PILIH GUDANG --</option>');
                  $.each(res,function(id_warehouse,warehouse_name){
                      $("#exitwarehouse").append(
                        '<option value="'+id_warehouse+'">'+warehouse_name+'</option>'
                      );
                  });
              }else{
                  $("#exitwarehouse").empty();
              }
              }
          });
      }else{
              $("#exitwarehouse").empty();
      }      
  });

  $('#exitwarehouse').change(function(){
      var warehouseid = $(this).val(); 
      let satkerid = $('#exitsatker').val();
      if(satkerid){
          $.ajax({
              type:"GET",
              url:"/admin-user/get_pallet_id?warehouseid="+warehouseid+"&& satkerid="+satkerid,
              dataType: 'JSON',
              success:function(res){    
              if(res){
                  $("#exitpallet").empty();
                  $("#exitpallet").append('<option value="">-- Pilih Pallet --</option>');
                  $.each(res,function(id_order_data,slot_id){
                      $("#exitpallet").append(
                        '<option value="'+slot_id+'">'+slot_id+'</option>'
                      );
                  });
              }else{
                  $("#exitpallet").empty();
              }
              }
          });
      }else{
              $("#exitpallet").empty();
      }      
  });  

  $(document).on('change', '.exitwarehouse2', function(){
      var warehouseid = $(this).val(); 
      let satkerid = $('#exitsatker').val();
      let idtarget = $(this).data('idtarget'); 
      let slotid = $('.slot_id').val();
      if(satkerid){
          $.ajax({
              type:"GET",
              url:"/admin-user/get_pallet_id_not_in?warehouseid="+warehouseid+"&& satkerid="+satkerid,
              data:{"data":data},
              dataType: 'JSON',
              success:function(res){     
              console.log(res);     
              if(res){
                  $("#ep2" + idtarget).empty();
                  $("#ep2" + idtarget).append('<option value="">-- Pilih Pallet --</option>');
                  $.each(res,function(slot_id,slot_id){
                      $("#ep2" + idtarget).append(
                        '<option value="'+slot_id+'">'+slot_id+'</option>'
                      );
                  });
              }else{
                  $("#ep2" + idtarget).empty();
              }
              }
          });
      }else{
              $("#ep2" + idtarget).empty();
      }      
  });

  $('#exitpallet').change(function(){
      var slotid = $(this).val(); 
      if(slotid){
          $.ajax({
              type:"GET",
              url:"/admin-user/get_item_id?slotid="+slotid,
              dataType: 'JSON',
              success:function(res){        
              if(res){
                  $("#itemcode").empty();
                  $("#itemcode").append('<option value="">-- Pilih Barang --</option>');
                  $.each(res,function(item_code,item_name){
                      $("#itemcode").append(
                        '<option value="'+item_code+'">'+item_name+'</option>'
                      );
                  });
              }else{
                  $("#itemcode").empty();
              }
              }
          });
      }else{
              $("#itemcode").empty();
      }      
  });  

  $(document).on('change', '.exitpallet2', function(){
      var slotid = $(this).val(); 
      let idtarget2 = $(this).data('idtarget2');
      if(slotid){
          $.ajax({
              type:"GET",
              url:"/admin-user/get_item_id?slotid="+slotid,
              dataType: 'JSON',
              success:function(res){        
              if(res){
                  $("#getitm" + idtarget2).empty();
                  $("#getitm" + idtarget2).append('<option value="">-- Pilih Barang --</option>');
                  $.each(res,function(item_code,item_name){
                      $("#getitm" + idtarget2).append(
                        '<option value="'+item_code+'">'+item_name+'</option>'
                      );
                  });
              }else{
                  $("#getitm" + idtarget2).empty();
              }
              }
          });
      }else{
              $("#getitm" + idtarget2).empty();
      }      
  });

  $('#itemcode').change(function(){
      var itemcode = $(this).val();  
      if(itemcode){
          $.ajax({
              type:"GET",
              url:"/admin-user/get_item?itemcode="+itemcode,
              dataType: 'JSON',
              success:function(res){               
                  var resultData = res.data;
                  $("#itemcategory").empty();
                  $("#itemname").empty();
                  $("#itemweight").empty();
                  $("#itemheight").empty();
                  $("#itemqty").empty();
                  $("#itemdescription").empty();
                  $.each(resultData,function(index,row){
                      $("#itemcategory").append(
                        '<select class="form-control" name="itemcategory_id[]" readonly><option value="'+row.id_item_category+'">'+row.itemcategory_name+'</option></select>'
                      );
                      $("#itemname").append(
                        '<input type="text" class="form-control" name="item_name[]" value="'+row.item_name+'" readonly>'
                      );
                      $("#itemweight").append(
                        '<input type="text" class="form-control" name="item_weight[]" value="'+row.item_weight+'" readonly>'
                      );
                      $("#itemheight").append(
                        '<input type="text" class="form-control" name="item_height[]" value="'+row.item_height+'" readonly>'
                      );
                      $("#itemqty").append(
                        '<input type="text" class="form-control" name="item_qty[]" value="'+row.item_qty+'" readonly>'
                      );
                      $("#itemdescription").append(
                        '<input type="text" class="form-control" name="description[]" value="'+row.description+'" readonly>'
                      );
                  });
              }
          });
      }else{
              
      }      
  });

  $(document).on('change', '.itemname2', function(){
      var itemcode = $(this).val(); 
      let idtarget = $(this).data('idtarget');

      if(itemcode){
          $.ajax({
              type:"GET",
              url:"/admin-user/get_item?itemcode="+itemcode,
              dataType: 'JSON',
              success:function(res){              
                  var resultData = res.data;
                  $("#itemcategory" + idtarget).empty();
                  $("#itemname" + idtarget).empty();
                  $("#itemweight" + idtarget).empty();
                  $("#itemheight" + idtarget).empty();
                  $("#itemqty" + idtarget).empty();
                  $("#itemdescription" + idtarget).empty();
                  $.each(resultData,function(index,row){
                      $("#itemcategory"+ idtarget).append(
                        '<select class="form-control" name="itemcategory_id[]" readonly><option value="'+row.id_item_category+'">'+row.itemcategory_name+'</option></select>'
                      );
                      $("#itemname" + idtarget).append(
                        '<input type="text" class="form-control" name="item_name[]" value="'+row.item_name+'" readonly>'
                      );
                      $("#itemweight" + idtarget).append(
                        '<input type="text" class="form-control" name="item_weight[]" value="'+row.item_weight+'" readonly>'
                      );
                      $("#itemheight" + idtarget).append(
                        '<input type="text" class="form-control" name="item_height[]" value="'+row.item_height+'" readonly>'
                      );
                      $("#itemqty" + idtarget).append(
                        '<input type="text" class="form-control" name="item_qty[]" value="'+row.item_qty+'" readonly>'
                      );
                      $("#itemdescription" + idtarget).append(
                        '<input type="text" class="form-control" name="description[]" value="'+row.description+'" readonly>'
                      );
                  });
                  console.log("#itemcategory" + idtarget); 
              }
          });
      }else{
              
      }      
  });

  // =========================================
  // MENDAPATKAN DATA ID ORDER DATA 
  // =========================================

  $(document).on('change', '.setorderdataid', function(){
      var slotid = $(this).val(); 
      if(slotid){
          $.ajax({
              type:"GET",
              url:"/admin-user/get_orderdata_id?slotid="+slotid,
              dataType: 'JSON',
              success:function(res){        
              if(res){
                  $("#getorderdataid").empty();
                  $.each(res,function(id_order_data,id_order_data){
                    console.log(id_order_data);
                      $("#getorderdataid").append(
                        '<input type="hidden" class="form-control" name="getorderdataid[]" value="'+id_order_data+'" readonly>'
                      );
                  });
              }else{
                  $("#getorderdataid").empty();
              }
              }
          });
      }else{
              $("#getorderdataid").empty();
      }      
  });  

  $(document).on('change', '.setorderdataid2', function(){
      var slotid = $(this).val(); 
      let idtarget = $(this).data('idtarget2');
      if(slotid){
          $.ajax({
              type:"GET",
              url:"/admin-user/get_orderdata_id?slotid="+slotid,
              dataType: 'JSON',
              success:function(res){          
              if(res){
                  $("#getorderdataid" + idtarget).empty();
                  $.each(res,function(id_order_data,id_order_data){
                    console.log(id_order_data);
                      $("#getorderdataid" + idtarget).append(
                        '<input type="hidden" class="form-control" name="getorderdataid['+idtarget+']" value="'+id_order_data+'" readonly>'
                      );
                  });
              }else{
                  $("#getorderdataid").empty();
              }
              }
          });
      }else{
              $("#getorderdataid" + idtarget).empty();
      }      
  });


  </script>

</body>
</html>