@extends('layout.tampilan')
@section('title', 'Simpanan - Koperasi MAN Insan Cendekia')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Halaman Simpanan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active" href="#" >Simpanan</li>
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
                  <th width="">Anggota</th>
                  <th width="">Jenis Simpanan</th>
                  <th width="">Tanggal Simpan</th>
                  <th width="12%">Act</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $index=>$d)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$d->nama_anggota}}</td>
                  <td>{{$d->nama_jenis}}</td>
                  <td>{{$d->tgl_simpan}}</td>
                  <td>
                    <div class="btn-group">
                      <a data-toggle="modal" data-target="#detail{{$d->id}}"><button class="btn btn-outline-info btn-sm">Detail</button></a>

                      <a data-toggle="modal" data-target="#edit{{$d->id}}"><button class="btn btn-outline-warning btn-sm">Edit</button></a>

                      <a href="{{url('simpanan-hapus', $d->id)}}" onclick="return confirm('Hapus data ini?')"><button class="btn btn-outline-danger btn-sm">Hapus</button></a>
                    </div>
                  </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="card-header">
                        <span class="card-title">Form Ubah Data Simpanan</span>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <form action="{{url('simpanan-update', $d->id)}}" method="post" enctype="multipart/form-data">
                              @method('put')
                              @csrf
                              @php
                                $anggota = \DB::table('user')->where('kode_hapus', 0)->get();
                              @endphp
                              <div class="form-group">
                                <label for="team">Nama</label>
                                <span class="text-danger">*</span>
                                <select required="" class="form-control" id="status" name="id_user">
                                  <option value="">Select Anggota</option>
                                  @foreach($anggota as $a)
                                  <option value="{{$a->id}}" {{$d->id_user == $a->id?'selected':''}}>{{$a->nama}}</option>
                                  @endforeach
                                </select>
                              </div>
                              @php
                                $jenis = \DB::table('jenis')->where('kode_hapus', 0)->get();
                              @endphp
                              <div class="row">
                                <div class="col-6 form-group">
                                  <label for="team">Jenis Simpanan</label>
                                  <span class="text-danger">*</span>
                                  <select required="" class="form-control" id="status" name="id_jenis">
                                    <option value="">Select Jenis Simpanan</option>
                                    @foreach($jenis as $j)
                                      <option value="{{$j->id}}" {{$d->id_jenis == $j->id?'selected':''}}>{{$j->jenis}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="col-6 form-group">
                                    <label for="team">Tanggal Simpan</label>
                                    <span class="text-danger">*</span>
                                    <input required class="form-control" type="date" name="tgl_simpan" value="{{$d->tgl_simpan}}">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="team">Keterangan</label>
                                <textarea class="form-control" rows="4" placeholder="Keterangan" type="text" name="keterangan">{{$d->keterangan}}</textarea>
                              </div>
                              <div class="row">
                                <div class="col-6 form-group">
                                  <label for="team">Nominal Simpan</label>
                                  <span class="text-danger">*</span>
                                  <input required class="form-control" type="number" placeholder="ex:250000" name="nominal" value="{{$d->nominal}}">
                                </div>
                                <div class="col-6 form-group">
                                  <label for="team">Bukti Bayar</label>
                                  <input class="form-control" type="file" name="bukti_bayar">
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
                          <label>Detail Simpanan</label>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-6">
                                  <label>Jenis Simpanan</label>
                                </div>
                                <div>{{$d->nama_jenis}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Nama Anggota</label>
                                </div>
                                <div>{{$d->nama_anggota}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Kontak Anggota</label>
                                </div>
                                <div>{{$d->nohp}} <a style="color: green" target="_blank" href="https://api.whatsapp.com/send?phone={{ $d->nohp}}" ><ion-icon name="logo-whatsapp"></ion-icon></a></div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Nominal</label>
                                </div>
                                <div>{{$d->nominal}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Keterangan</label>
                                </div>
                                <div>{{$d->keterangan}}</div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <label>Bukti Bayar</label>
                                </div>
                                <div class="col">
                                  
                                </div>
                              </div>
                              <div><img src="{{ asset('image/simpanan/'.$d->bukti_bayar) }}" alt="bukti" width="50%">
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
          <span class="card-title">Form Tambah Simpanan</span>
        </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form action="{{url('simpanan-store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @php
                    $anggota = \DB::table('user')->where('kode_hapus', 0)->get();
                  @endphp
                  <div class="form-group">
                    <label for="team">Nama</label>
                    <span class="text-danger">*</span>
                    <select required="" class="form-control" id="status" name="id_user">
                      <option value="">Select Anggota</option>
                      @foreach($anggota as $a)
                      <option value="{{$a->id}}">{{$a->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  @php
                    $jenis = \DB::table('jenis')->where('kode_hapus', 0)->get();
                  @endphp
                  <div class="row">
                    <div class="col-6 form-group">
                      <label for="team">Jenis Simpanan</label>
                      <span class="text-danger">*</span>
                      <select required="" class="form-control" id="status" name="id_jenis">
                        <option value="">Select Jenis Simpanan</option>
                        @foreach($jenis as $j)
                        <option value="{{$j->id}}">{{$j->jenis}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="team">Tanggal Simpan</label>
                        <span class="text-danger">*</span>
                        <input required class="form-control" type="date" name="tgl_simpan">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="team">Keterangan</label>
                    <textarea class="form-control" rows="4" placeholder="Keterangan" type="text" name="keterangan"></textarea>
                  </div>
                  <div class="row">
                    <div class="col-6 form-group">
                      <label for="team">Nominal Simpan</label>
                      <span class="text-danger">*</span>
                      <input required class="form-control" type="number" placeholder="ex:250000" name="nominal">
                    </div>
                    <div class="col-6 form-group">
                      <label for="team">Bukti Bayar</label>
                      <input class="form-control" type="file" name="bukti_bayar">
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