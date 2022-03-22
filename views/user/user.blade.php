@extends('layout.tampilan')
@section('title', 'Pengguna - Koperasi MAN Insan Cendekia')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Pengguna</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active" href="#" >Pengguna</li>
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
                  <th width="">#</th>
                  <th width="15%">Nama</th>
                  <th width="8%">Role</th>
                  <th width="13%">Tempat Lahir</th>
                  <th width="10%">Tgl Lahir</th>
                  <th width="15%">Alamat</th>
                  <th width="">Pekerjaan</th>
                  <th width="12%">Act</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $index=>$d)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$d->nama}}</td>
                  <td>{{$d->role}}</td>
                  <td>{{$d->tempat_lahir}}</td>
                  <td>{{$d->tgl_lahir}}</td>
                  <td>{{$d->alamat}}</td>
                  <td>{{$d->pekerjaan}}</td>
                  <td>
                    <div class="btn-group">
                      <a data-toggle="modal" data-target="#detail{{$d->id}}"><button class="btn btn-outline-info btn-sm">Detail</button></a>

                      <a data-toggle="modal" data-target="#edit{{$d->id}}"><button class="btn btn-outline-warning btn-sm">Edit</button></a>

                      <a href="{{url('user-hapus', $d->id)}}" onclick="return confirm('Hapus data ini?')"><button class="btn btn-outline-danger btn-sm">Hapus</button></a>
                    </div>
                  </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="card-header">
                        <span class="card-title">Form Ubah Data Pengguna</span>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <form action="{{url('user-update', $d->id)}}" method="post" enctype="multipart/form-data">
                              @method('put')
                              @csrf
                              <div class="form-group">
                                <label for="team">Nama</label>
                                <span class="text-danger">*</span>
                                <input required class="form-control" type="text" name="nama" value="{{$d->nama}}">
                              </div>
                              <div class="row">
                                <div class="col-6 form-group">
                                  <label for="team">Username</label>
                                  <span class="text-danger">*</span>
                                  <input required class="form-control" type="text" name="username" value="{{$d->username}}">
                                </div>
                                <div class="col-6 form-group">
                                  <label for="team">Password</label>
                                  <input class="form-control" type="password" name="password">
                                  <span class="text-danger text-sm">Kosongkan jika tak diubah</span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="team">Alamat</label>
                                <span class="text-danger">*</span>
                                <input required class="form-control" type="text" name="alamat" value="{{$d->alamat}}">
                              </div>
                              <div class="row">               
                                <div class="col-6 form-group">
                                  <label for="team">Pekerjaan</label>
                                  <span class="text-danger">*</span>
                                  <input required class="form-control" type="text" name="pekerjaan" value="{{$d->pekerjaan}}">
                                </div>
                                <div class="col-6 form-group">
                                  <label for="jenkel">Status</label>
                                  <span class="text-danger">*</span>
                                  <select required="" class="form-control" id="status" name="status">
                                      <option value="">Select Status</option>
                                      <option value="Anggota" {{$d->role == "Anggota"?'selected':''}}>Anggota Koperasi</option>
                                      <option value="Admin" {{$d->role == "Admin"?'selected':''}}>Admin</option>
                                      <option value="Atasan" {{$d->role == "Atasan"?'selected':''}}>Atasan</option>
                                  </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-6 form-group">
                                  <label for="team">Tempat Lahir</label>
                                  <input class="form-control" type="text" name="tempat_lahir" value="{{$d->tempat_lahir}}">
                                </div>
                                <div class="col-6 form-group">
                                  <label for="team">Tgl Lahir</label>
                                  <span class="text-danger">*</span>
                                  <input required class="form-control" type="date" name="tgl_lahir" value="{{$d->tgl_lahir}}">
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-6 form-group">
                                  <label for="team">No HP</label>
                                  <span class="text-danger">*</span>
                                  <input required class="form-control" placeholder="ex:621234567890" type="text" name="nohp" value="{{$d->nohp}}">
                                </div>
                                <div class="col-6 form-group">
                                  <label for="team">Foto</label>
                                  <input class="form-control" type="file" name="foto">
                                </div>
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

                <!-- Modal Detail -->
                <div class="modal fade" id="detail{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="card-content">
                        <div class="modal-header">
                          <label>Detail Pengguna</label>
                          <label class="text-right text-success">{{$d->role}}</label>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-6">
                                  <label>Nama/Username</label>
                                </div>
                                <div>{{$d->nama}} / {{$d->username}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>TTL</label>
                                </div>
                                <div>{{$d->tempat_lahir}}, {{$d->tgl_lahir}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>No HP</label>
                                </div>
                                <div>
                                  {{$d->nohp}} <a style="color: green" target="_blank" href="https://api.whatsapp.com/send?phone={{ $d->nohp}}" ><ion-icon name="logo-whatsapp"></ion-icon></a>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Pekerjaan</label>
                                </div>
                                <div>{{$d->pekerjaan}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Alamat</label>
                                </div>
                                <div>{{$d->alamat}}</div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <label>Foto</label>
                                </div>
                                <div class="col">
                                  
                                </div>
                              </div>
                              <div><img src="{{ asset('image/foto/'.$d->foto) }}" alt="foto" width="50%">
                                  </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                </div>
                <!-- /Modal Detail -->
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
                  <span class="card-title">Form Tambah Pengguna</span>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                          <form action="{{url('user-store')}}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                  <label for="team">Nama</label>
                                  <span class="text-danger">*</span>
                                  <input required class="form-control" type="text" name="nama">
                              </div>
                              <div class="row">
                                <div class="col-6 form-group">
                                    <label for="team">Username</label>
                                    <span class="text-danger">*</span>
                                    <input required class="form-control" type="text" name="username">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="team">Password</label>
                                    <span class="text-danger">*</span>
                                    <input required class="form-control" type="password" name="password">
                                </div>
                              </div>
                              <div class="form-group">
                                  <label for="team">Alamat</label>
                                  <span class="text-danger">*</span>
                                  <input required class="form-control" type="text" name="alamat">
                              </div>
                              <div class="row">                                
                                <div class="col-6 form-group">
                                    <label for="team">Pekerjaan</label>
                                    <span class="text-danger">*</span>
                                    <input required class="form-control" type="text" name="pekerjaan">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="jenkel">Status</label>
                                    <span class="text-danger">*</span>
                                    <select required="" class="form-control" id="status" name="status">
                                        <option value="">Select Status</option>
                                        <option value="Anggota">Anggota Koperasi</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Atasan">Atasan</option>
                                    </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-6 form-group">
                                    <label for="team">Tempat Lahir</label>
                                    <input class="form-control" type="text" name="tempat_lahir">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="team">Tgl Lahir</label>
                                    <span class="text-danger">*</span>
                                    <input required class="form-control" type="date" name="tgl_lahir">
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-6 form-group">
                                    <label for="team">No HP</label>
                                    <span class="text-danger">*</span>
                                    <input required class="form-control" placeholder="ex:621234567890" type="text" name="nohp">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="team">Foto</label>
                                    <input class="form-control" type="file" name="foto">
                                </div>
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