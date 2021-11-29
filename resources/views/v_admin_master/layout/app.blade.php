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
            <i class="fas fa-sign-out-alt" title="Keluar"> Keluar</i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" >
      <!-- Brand Logo -->
      <a href="{{ url('admin-master/dashboard') }}" class="brand-link">
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
            <a href="{{ url('admin-master/show_profile/'. Auth::id()) }}" class="d-block" style="margin-top: 0.3vh;">{{ Auth::user()->full_name }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{ url('admin-master/dashboard') }}" class="nav-link {{ Request::is('admin-master/dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{ url('admin-master/show_warehouse') }}" class="nav-link {{ Request::is('admin-master/show_warehouse') ? 'active' : '' }}">
                <i class="nav-icon fas fa-warehouse"></i>
                <p>
                  Gudang
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('admin-master/show_user') }}" class="nav-link {{ Request::is('admin-master/show_user') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Pengguna
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
                  <a href="{{ url('admin-master/category_item/') }}" class="nav-link {{ Request::is('admin-master/category_item') ? 'active' : '' }}">
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
                  Data Pengiriman
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin-master/show_entry_item') }}" class="nav-link {{ Request::is('admin-master/show_entry_item') ? 'active' : '' }}">
                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                    <p>Barang Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin-master/show_exit_item') }}" class="nav-link {{ Request::is('admin-master/show_exit_item') ? 'active' : '' }}">
                    <i class="fas fa-chevron-circle-left nav-icon"></i>
                    <p>Barang Keluar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin-master/show_history') }}" class="nav-link {{ Request::is('admin-master/show_history') ? 'active' : '' }}">
                    <i class="fas fa-history nav-icon"></i>
                    <p>Riwayat</p>
                  </a>
                </li>
              </ul>
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
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">mfahmifadh</a>.</strong>
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
      // Data Table
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "searching":true, "paging": true, "info": true,
        "buttons": ["print","pdf","excel"]
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
      $('.summernote').summernote();
      //-------------
        //- BAR CHART -
        //-------------
        var url = "{{ url('admin-master/chart_total_order') }}"
        var Month      = new Array();
        var TotalScore = new Array();
        $(document).ready(function(){
          $.get(url, function(response){
              response.forEach(function(data){
                Month.push(data.month);
                TotalScore.push(data.totalscore);
              });

          var barChartCanvas = $('#barChart').get(0).getContext('2d')
          var barChartData = {
            labels  : Month,
            datasets: [
              {
                label               : 'Total Kartu Kuning',
                backgroundColor     : '#FFC107',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius          : false,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : TotalScore
              }
              
            ]
          }
          var temp0 = barChartData.datasets[0]
          barChartData.datasets[0] = temp0

          var barChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false
          }

          new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          })
        });
      });
    });

  </script>
</body>
</html>