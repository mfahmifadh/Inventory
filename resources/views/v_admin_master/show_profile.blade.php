@extends('v_admin_master.layout.app')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
    	<div class="container">
	        <div class="row mb-2">
	          <div class="col-sm-6"></div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ url('admin-master/dashboard') }}">Dashboard</a></li>
	              <li class="breadcrumb-item active">Edit Profil</li>
	            </ol>
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
    	</div>
    </div>
    <!-- /.content-header -->

    @foreach($satker as $data)
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<div class="card card-warning">
						<div class="card-header">
							<h5 class="card-title"><b>EDIT PROFIL</b></h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin-master/edit_profile/'. $data->id) }}" method="POST">
                            @csrf
                                <input type="hidden" name="workunit_id" value="{{ $data->workunit_id }}">
                                <input type="hidden" name="password" value="{{ $data->password }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">NIP : </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="id" value="{{ $data->id }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">SATUAN KERJA : </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                                </div>
                                                <input type="text" style="text-transform:uppercase;" class="form-control" value="{{ $data->full_name }}" readonly >
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">EMAIL : </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                                                </div>
                                                <input type="email" class="form-control" name="email" value="{{ $data->email }}" placeholder="Masukan Email (Tidak Wajib Diisi)">
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">USERNAME : </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="username" value="{{ $data->username }}">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">&nbsp;</label>
                                            <div class="input-group mb-3">
                                                <button type="submit" class="form-control btn btn-primary" onclick="return confirm('Yakin ingin mengubah data ?')">UBAH </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
                        <div class="card-header">
                            <h5 class="card-title"><b>GANTI PASSWORD</b></h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin-master/edit_password/'. $data->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="cekpassword" value="{{ $data->password }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">PASSWORD LAMA : </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="oldpassword" placeholder="Masukan Password Lama">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">PASSWORD BARU : </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="password" minlength="8" placeholder="Masukan Password Baru">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for=""></label>
                                            <div class="input-group mb-3">
                                                <button type="submit" class="form-control btn btn-primary" onclick="return confirm('Yakin ingin mengubah data ?')">GANTI PASSWORD</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
					</div>
				</div>
            </div><!-- /.row -->
        </div>
    </div>
    <!-- /.content -->
    @endforeach

@endsection