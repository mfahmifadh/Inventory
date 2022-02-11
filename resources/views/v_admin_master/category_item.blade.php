@extends('v_admin_master.layout.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin-master/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kategori Barang</li>
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
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title left" style="float:left;margin-top: 0.5vh;"><b>DATA KATEGORI BARANG</b></h3>
                    <h3 class="card-title right" style="float:right;">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-category">
                        <i class="fas fa-plus-circle"></i> KATEGORY
                    </a>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kategori Barang</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1;?>
                        @foreach($category_item as $row)
                        <tr>
                            <td>{{ $row->id_item_category }}</td>
                            <td>{{ $row->itemcategory_name }}</td>
                            <td class="td-status">
                                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit-category{{$row->id_item_category}}"><b>EDIT</b></a> 
                                <!-- <form action="{{ url('admin-master/delete_category/'. $row->id_item_category) }} " method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kategori ini ?')"><b>HAPUS</b></button>
                                </form> -->
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Kode</th>
                            <th>Kategori Barang</th>
                            <th>Aksi</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div>
    </section>

    <div class="modal fade" id="modal-add-category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Kategori Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('admin-master/add_category_item') }}" method="POST">
                @csrf
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Kategori Barang :</label>
                            <input type="text" class="form-control" name="itemcategory_name" placeholder="Masukan Kategori Baru" style="text-transform: uppercase;" required>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @foreach($category_item as $row)
    <div class="modal fade" id="modal-edit-category{{ $row->id_item_category }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Edit Kategori Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin-master/edit_category_item/'. $row->id_item_category) }}" method="POST">
                @csrf
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Kategori Barang :</label>
                            <input type="text" class="form-control" name="itemcategory_name" style="text-transform: uppercase;" value="{{ $row->itemcategory_name }}">
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
@endsection