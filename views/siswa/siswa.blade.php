@extends('layout.tampilan')
@section('title', 'Siswa - Koperasi MAN Insan Cendekia')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Halaman Siswa</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active" href="#" >Siswa</li>
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
                  <th width="">Nama</th>
                  <th width="8%">Jenkel</th>
                  <th width="8%">Golongan</th>
                  {{--<th width="">Ortu</th>
                  <th width="">Telp Ortu</th>--}}
                  <th width="">Alamat</th>
                  <th width="12%">Act</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $index=>$d)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$d->nama}}</td>
                  <td>{{$d->gender}}</td>
                  <td>{{$d->golongan}}</td>
                  {{--<td>{{$d->nama_ortu}}</td>
                  <td>{{$d->nohp_ortu}}</td>--}}
                  <td>{{$d->alamat}}</td>
                  <td>
                    <div class="btn-group">
                      <a data-toggle="modal" data-target="#detail{{$d->id}}"><button class="btn btn-outline-info btn-sm">Detail</button></a>

                      <a data-toggle="modal" data-target="#edit{{$d->id}}"><button class="btn btn-outline-warning btn-sm">Edit</button></a>

                      <a href="{{url('siswa-hapus', $d->id)}}" onclick="return confirm('Hapus data ini?')"><button class="btn btn-outline-danger btn-sm">Hapus</button></a>
                    </div>
                  </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="card-header">
                        <span class="card-title">Form Ubah Data Siswa</span>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <form action="{{url('siswa-update', $d->id)}}" method="post" enctype="multipart/form-data">
                              @method('put')
                              @csrf
                              <div class="form-group">
                                <label>NISN</label>
                                <span class="text-danger">*</span>
                                <input required class="form-control" type="text" name="nisn" value="{{$d->nisn}}">
                              </div>
                              <div class="row">
                                <div class="col-6 form-group">
                                  <label>Nama</label>
                                  <span class="text-danger">*</span>
                                  <input required class="form-control" type="text" name="nama" value="{{$d->nama}}">
                                </div>
                                <div class="col-6 form-group">
                                  <label>Jenis Kelamin</label>
                                  <span class="text-danger">*</span>
                                  <select required="" class="form-control" id="status" name="gender">
                                    <option value="">Select Jenis Kelamin</option>
                                    <option value="Perempuan" {{$d->gender == "Perempuan"?'selected':''}}>Perempuan</option>
                                    <option value="Laki-laki" {{$d->gender == "Laki-laki"?'selected':''}}>Laki-laki</option>
                                  </select>
                                </div>
                              </div>
                              @php
                                $gol = \DB::table('golongan')->where('kode_hapus', 0)->get();
                              @endphp
                              <div class="form-group">
                                <label>Golongan</label>
                                <span class="text-danger">*</span>
                                <select required="" class="form-control" id="status" name="id_golongan">
                                  <option value="">Select Golongan</option>
                                  @foreach($gol as $g)
                                  <option value="{{$g->id}}" {{$d->id_golongan == $g->id?'selected':''}}>{{$g->golongan}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="row">
                                <div class="col-6 form-group">
                                  <label>Nama Orang Tua</label>
                                  <span class="text-danger">*</span>
                                  <input required class="form-control" type="text" name="nama_ortu" value="{{$d->nama_ortu}}">
                                </div>
                                <div class="col-6 form-group">
                                  <label>Telp Orang Tua</label>
                                  <span class="text-danger">*</span>
                                  <input required class="form-control" type="text" name="nohp_ortu" value="{{$d->nohp_ortu}}">
                                </div>
                              </div>                              
                              <div class="form-group">
                                <label>Alamat</label>
                                <span class="text-danger">*</span>
                                <input required class="form-control" type="text" name="alamat" value="{{$d->alamat}}">
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
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-6">
                                  <label>NISN</label>
                                </div>
                                <div>{{$d->nisn}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Nama</label>
                                </div>
                                <div>{{$d->nama}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Jenis Kelamin</label>
                                </div>
                                <div>{{$d->gender}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Golongan</label>
                                </div>
                                <label>{{$d->golongan}}</label>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Orang Tua</label>
                                </div>
                                <div>{{$d->nama_ortu}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>No HP Orang Tua</label>
                                </div>
                                <div>
                                  {{$d->nohp_ortu}} <a style="color: green" target="_blank" href="https://api.whatsapp.com/send?phone={{ $d->nohp_ortu}}" ><ion-icon name="logo-whatsapp"></ion-icon></a>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Alamat</label>
                                </div>
                                <div>{{$d->alamat}}</div>
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
                          <form action="{{url('siswa-store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label>NISN</label>
                              <span class="text-danger">*</span>
                              <input required class="form-control" type="text" name="nisn">
                            </div>
                            <div class="row">
                              <div class="col-6 form-group">
                                <label>Nama</label>
                                <span class="text-danger">*</span>
                                <input required class="form-control" type="text" name="nama">
                              </div>
                              <div class="col-6 form-group">
                                <label>Jenis Kelamin</label>
                                <span class="text-danger">*</span>
                                <select required="" class="form-control" id="status" name="gender">
                                  <option value="">Select Jenis Kelamin</option>
                                  <option value="Perempuan">Perempuan</option>
                                  <option value="Laki-laki">Laki-laki</option>
                                </select>
                              </div>
                            </div>
                            @php
                              $gol = \DB::table('golongan')->where('kode_hapus', 0)->get();
                            @endphp
                            <div class="form-group">
                              <label>Golongan</label>
                              <span class="text-danger">*</span>
                              <select required="" class="form-control" id="status" name="id_golongan">
                                <option value="">Select Golongan</option>
                                @foreach($gol as $g)
                                <option value="{{$g->id}}">{{$g->golongan}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="row">
                              <div class="col-6 form-group">
                                <label>Nama Orang Tua</label>
                                <span class="text-danger">*</span>
                                <input required class="form-control" type="text" name="nama_ortu">
                              </div>
                              <div class="col-6 form-group">
                                <label>Telp Orang Tua</label>
                                <span class="text-danger">*</span>
                                <input required class="form-control" type="text" name="nohp_ortu" placeholder="ex:628123456789">
                              </div>
                            </div>                              
                            <div class="form-group">
                              <label>Alamat</label>
                              <span class="text-danger">*</span>
                              <input required class="form-control" type="text" name="alamat">
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