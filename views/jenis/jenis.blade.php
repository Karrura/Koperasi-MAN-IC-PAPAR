@extends('layout.tampilan')
@section('title', 'Jenis - Koperasi MAN Insan Cendekia')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Halaman Jenis</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active" href="#" >Jenis</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container"> 
    <div class="container-fluid">
      <div class="card mb-2">
        <div class="card-header text-right">
            <a class="btn btn-info mb-1 text-right" data-toggle="modal" data-target="#modalTambah" style="color: white;">Tambah Data</a>
        </div>
        <div class="card-body">
          @if(Session::has('success'))
              <div class="alert alert-primary">
                  {{Session::get('success')}}
              </div>
          @endif
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="example1">
              <thead>
                <tr style="text-align: center;">
                  <th width="5%">#</th>
                  <th width="">Jenis</th>
                  <th width="">Keterangan</th>
                  <th width="10%">Act</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $index=>$d)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$d->jenis}}</td>
                  <td>{{$d->keterangan}}</td>
                  <td>
                    <div class="btn-group">
                      <a data-toggle="modal" data-target="#edit{{$d->id}}"><button class="btn btn-outline-warning btn-sm">Edit</button></a>

                      <a href="{{url('jenis-hapus', $d->id)}}" onclick="return confirm('Hapus data ini?')"><button class="btn btn-outline-danger btn-sm">Hapus</button></a>
                    </div>
                  </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="card-header">
                        <span class="card-title">Form Ubah Data Jenis</span>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <form action="{{url('jenis-update', $d->id)}}" method="post" enctype="multipart/form-data">
                              @method('put')
                              @csrf
                              <div class="form-group">
                                <label for="team">Jenis</label>
                                <span class="text-danger">*</span>
                                <input required class="form-control" type="text" name="jenis" value="{{$d->jenis}}">
                              </div>
                              <div class="form-group">
                                <label for="team">Keterangan</label>
                                {{--<span class="text-danger">*</span>--}}
                                <input class="form-control" type="text" name="keterangan" value="{{$d->keterangan}}">
                              </div>
                              <div class="text-right">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Modal Edit -->
                @endforeach
              </tbody>
            </table>
          </div>
        </div>    
      </div>
    </div>
</div>
<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="card-content">
              <div class="modal-header">
                  <span class="card-title">Form Tambah Jenis</span>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                          <form action="{{url('jenis-store')}}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                <label for="team">Jenis</label>
                                <span class="text-danger">*</span>
                                <input required class="form-control" type="text" name="jenis">
                              </div>
                              <div class="form-group">
                                <label for="team">Keterangan</label>
                                {{--<span class="text-danger">*</span>--}}
                                <textarea class="form-control" rows="4" placeholder="Deskripsi" type="text" name="keterangan"></textarea>
                              </div>
                              <div class="text-right">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
              <!-- /.card-body -->
      </div>
  </div>
</div>
<!-- /Modal Tambah -->
@endsection