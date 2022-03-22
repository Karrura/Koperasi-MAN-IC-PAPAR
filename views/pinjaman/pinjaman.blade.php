@extends('layout.tampilan')
@section('title', 'Pinjaman - Koperasi MAN Insan Cendekia')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Halaman Pinjaman</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active" href="#" >Pinjaman</li>
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
                <th width="">Tanggal Pinjam</th>
                <th width="">Tanggal Lunas</th>
                <th width="">Nominal Pinjam</th>
                <th>Total Bayar</th>
                <th width="">Status</th>
                <th width="">Act</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index=>$d)
              <tr>
                <td>{{$index+1}}</td>
                <td>{{$d->nama_anggota}}</td>
                <td class="text-center">{{$d->tgl_pinjam}}</td>
                <td class="text-center">
                  @php
                    if($d->tgl_lunas)
                      echo $d->tgl_lunas;
                    else
                      echo "--/--/--";
                  @endphp
                </td>
                <td class="text-right">{{$d->nominal}}</td>
                <td class="text-right">
                  @php
                    $total = ($d->nominal * 0.05) + $d->nominal;
                    echo $total;
                  @endphp
                </td>
                @php
                    $cekstatus = \DB::table('angsuran')
                              ->join('pinjaman', 'pinjaman.id', '=', 'angsuran.id_pinjam')
                              ->where('angsuran.kode_hapus', 0)->where('angsuran.id_user', $d->id_user)->select('angsuran.nominal')
                              ->get();
                    $totalbayar = 0;
                    foreach($cekstatus as $key => $val){
                      $totalbayar += $val->nominal;
                    }
                    if($totalbayar >= $d->nominal){
                      $status = 'Lunas';
                    }else{
                      $status = 'Belum Lunas';
                    }
                  @endphp
                <td class="text-center"><span class="badge badge-{{$status == 'Lunas'?'success':'danger'}}">
                  {{$status}}
                </span></td>
                <td>
                  <div class="btn-group">
                    <a data-toggle="modal" data-target="#detail{{$d->id}}"><button class="btn btn-outline-info btn-sm">Detail</button></a>

                    <a data-toggle="modal" data-target="#edit{{$d->id}}"><button class="btn btn-outline-warning btn-sm">Edit</button></a>

                    <a href="{{url('pinjaman-hapus', $d->id)}}" onclick="return confirm('Hapus data ini?')"><button class="btn btn-outline-danger btn-sm">Hapus</button></a>
                  </div>
                </td>
              </tr>
              <!-- Modal Edit -->
              <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="card-header">
                      <span class="card-title">Form Ubah Data Pinjaman</span>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <form action="{{url('pinjaman-update', $d->id)}}" method="post" enctype="multipart/form-data">
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
                            <div class="form-group">
                              <label for="team">Tanggal Pinjam</label>
                              <span class="text-danger">*</span>
                              <input required class="form-control" type="date" name="tgl_pinjam" value="{{$d->tgl_pinjam}}">
                            </div>
                            <div class="form-group">
                              <label for="team">Nominal Pinjam</label>
                              <span class="text-danger">*</span>
                              <input required class="form-control" type="number" placeholder="ex:250000" name="nominal" value="{{$d->nominal}}">
                            </div>
                            <div class="form-group">
                              <label for="team">Keterangan</label>
                              <textarea class="form-control" rows="4" placeholder="Keterangan" type="text" name="keterangan">{{$d->keterangan}}</textarea>
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
                        <label>Detail Pinjaman</label>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
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
                                <label>Total Bayar</label>
                              </div>
                              <div>{{$total}}</div>
                            </div>
                            <div class="row">
                              <div class="col-6">
                                <label>Status</label>
                              </div>
                              <div><span class="badge badge-{{$status == 'Lunas'?'success':'danger'}}">{{$status}}</span></div>
                            </div>
                            <div class="row">
                              <div class="col-6">
                                <label>Tgl Pinjam</label>
                              </div>
                              <div>{{$d->tgl_pinjam}}</div>
                            </div>
                            <div class="row">
                              <div class="col-6">
                                <label>Tgl Lunas</label>
                              </div>
                              <div>
                                @php
                                  if($d->tgl_lunas)
                                    echo $d->tgl_lunas;
                                  else
                                    echo "--/--/--";
                                @endphp
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-6">
                                <label>Keterangan</label>
                              </div>
                              <div class="col-6">{{$d->keterangan}}</div>
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
          <span class="card-title">Form Tambah Pinjaman</span>
        </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form action="{{url('pinjaman-store')}}" method="post" enctype="multipart/form-data">
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
                  <div class="form-group">
                    <label for="team">Tanggal Pinjam</label>
                    <span class="text-danger">*</span>
                    <input required class="form-control" type="date" name="tgl_pinjam">
                  </div>
                  <div class="form-group">
                    <label for="team">Nominal Pinjam</label>
                    <span class="text-danger">*</span>
                    <input required class="form-control" type="number" placeholder="ex:250000" name="nominal">
                  </div>
                  <div class="form-group">
                    <label for="team">Keterangan</label>
                    <textarea class="form-control" rows="4" placeholder="Keterangan" type="text" name="keterangan"></textarea>
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