<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/login.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

    <title>Inventory | KEMENKES</title>
  </head>
  <body>

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('/assets/img/bg_1.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <center>
              <p><img src="{{ asset('assets/img/kemenkes.png') }}" alt="KEMENKES Logo" class="img-login animation__shake img-responsive"></p>
              <h3>Inventory <strong>KEMENKES</strong></h3>
              <p class="mb-4">Web Base Inventory KEMENKES.</p>
            </center>
            <div class="form-group first">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('failed'))
                    <div class="alert alert-danger">
                        <p style="color: white;">{{ $message }}</p>
                    </div>
                @endif
              </div> 
            <form action="{{ route('register.custom') }}" method="POST">
              @csrf             
              <div class="form-group first">
                <label for="nik">NIK</label>
                <input type="text" class="form-control" name="id" placeholder="Masukan Nomor Induk Karyawan">
              </div>             
              <div class="form-group first">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" class="form-control" name="full_name" placeholder="Masukan Nama Lengkap">
              </div>
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Masukan Username">
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="myInput" placeholder="Masukan Password" minlength="6">
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Show Password</span>
                  <input type="checkbox" onclick="myFunction()">
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="{{ route('login')}}" class="forgot-pass">Sudah punya akun</a></span> 
              </div>

              <button type="submit" class="btn btn-block btn-primary">DAFTAR</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    
    

  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/login.min.js') }}"></script>
  <script src="{{ asset('assets/js/login.js') }}"></script>
  <script type="text/javascript">
    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
  </body>
</html>