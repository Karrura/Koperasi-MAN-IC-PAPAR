@extends('layout.tampilan')
@section('title', 'Angsuran - Koperasi MAN Insan Cendekia')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Halaman Angsuran</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active" href="#" >Angsuran</li>
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
        <a class="btn btn-success mb-1 text-right ml-2" href="{{url('angsuran-data')}}" style="color: white; float: right">Kembali</a>
        <a class="btn btn-info mb-1 text-right" data-toggle="modal" data-target="#modalTambah" style="color: white; float: right">Tambah Data</a>
      </div>
      @php
      $data_user = \DB::table('user')
                  ->join('pinjaman', 'pinjaman.id_user', '=', 'user.id')
                  ->where('pinjaman.id', $id_pinjam)
                  ->where('pinjaman.kode_hapus', 0)->first();
      @endphp
      <div class="card-header">
        <div class="row">
          <div class="col-6">
            <label>Nama Anggota</label>
          </div>
          <div class="col-3">{{$data_user->nama}}</div>
        </div>
        <div class="row">
          <div class="col-6">
            <label>Kontak Anggota</label>
          </div>
          <div class="col-3">{{$data_user->nohp}} <a style="color: green" target="_blank" href="https://api.whatsapp.com/send?phone={{$data_user->nohp}}" ><ion-icon name="logo-whatsapp"></ion-icon></a></div>
        </div>
        <div class="row">
          <div class="col-6">
            <label>Nominal Pinjam</label>
          </div>
          <div class="col-3">{{$data_user->nominal}}</div>
        </div>
        <div class="row">
          <div class="col-6">
            @php
              $total = ($data_user->nominal * 0.05) + $data_user->nominal;
            @endphp
            <label>Total Bayar</label>
          </div>
          <div class="col-3">{{$total}}</div>
        </div>
        @php
          $cekstatus = \DB::table('angsuran')
                    ->join('pinjaman', 'pinjaman.id', '=', 'angsuran.id_pinjam')
                    ->where('angsuran.kode_hapus', 0)->where('angsuran.id_user', $data_user->id_user)->select('angsuran.nominal')
                    ->get();
          $totalbayar = 0;
          foreach($cekstatus as $key => $val){
            $totalbayar += $val->nominal;
          }
          if($totalbayar >= $data_user->nominal){
            $status = 'Lunas';
          }else{
            $status = 'Belum Lunas';
          }
        @endphp
        <div class="row">
          <div class="col-6">
            <label>Status</label>
          </div>
          <div class="col-3"><span class="badge badge-{{$status == 'Lunas'?'success':'danger'}}">{{$status}}</span></div>
        </div>
        <div class="row">
          <div class="col-6">
            <label>Tanggal Pinjam</label>
          </div>
          <div class="col-3">{{$data_user->tgl_pinjam}}</div>
        </div>
        <div class="row">
          <div class="col-6">
            <label>Tanggal Lunas</label>
          </div>
          <div class="col-3">
            @php
              if($data_user->tgl_lunas)
                echo $data_user->tgl_lunas;
              else
                echo "--/--/--";
            @endphp
          </div>
        </div>
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
                <th width="">Periode Bayar</th>
                <th width="15%">Tanggal Bayar</th>
                <th width="">Nominal</th>
                <th width="12%">Act</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index=>$d)
              <tr>
                <td>{{$index+1}}</td>
                <td>{{$d->periode_bayar}}</td>
                <td class="text-center">{{$d->tgl_bayar}}</td>
                <td class="text-right">{{$d->nominal}}</td>
                <td>
                  <div class="btn-group">
                    <a data-toggle="modal" data-target="#detail{{$d->id}}"><button class="btn btn-outline-info btn-sm">Detail</button></a>

                    <a data-toggle="modal" data-target="#edit{{$d->id}}"><button class="btn btn-outline-warning btn-sm">Edit</button></a>

                    <a href="{{url('angsuran-hapus', $d->id)}}" onclick="return confirm('Hapus data ini?')"><button class="btn btn-outline-danger btn-sm">Hapus</button></a>
                  </div>
                </td>
              </tr>
              <!-- Modal Edit -->
              <div class="modal fade" id="edit{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="card-header">
                      <span class="card-title">Form Ubah Data Angsuran</span>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <form action="{{url('angsuran-update', $d->id)}}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="text" readonly hidden name="id_pinjam" value="{{$id_pinjam}}">
                            @php
                              $anggota = \DB::table('user')->where('kode_hapus', 0)->get();
                            @endphp
                            <div class="form-group">
                              <label for="team">Nama</label>
                              <span class="text-danger">*</span>
                              <select required="" readonly class="form-control" name="id_user">
                                <option value="">Select Anggota</option>
                                @foreach($anggota as $a)
                                <option value="{{$a->id}}" {{$d->id_user == $a->id?'selected':''}}>{{$a->nama}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="row">
                              <div class="col-6 form-group">
                                <label for="team">Periode Bayar</label>
                                <span class="text-danger">*</span>
                                <input required class="form-control" type="text" placeholder="ex:Pembayarn ke-3" name="periode_bayar" value="{{$d->periode_bayar}}">
                              </div>
                              <div class="col-6 form-group">
                                <label for="team">Tanggal Bayar</label>
                                <span class="text-danger">*</span>
                                <input required class="form-control" type="date" name="tgl_bayar" value="{{$d->tgl_bayar}}">
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-6 form-group">
                                <label for="team">Nominal</label>
                                <span class="text-danger">*</span>
                                <input class="form-control" required type="text" name="nominal" placeholder="ex:250000" value="{{$d->nominal}}">
                              </div>
                              <div class="col-6 form-group">
                                <label for="team">Bukti Bayar</label>
                                <input class="form-control" type="file" name="bukti_bayar">
                              </div>
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
                          <label>Detail Angsuran</label>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-6">
                                  <label>Tgl Bayar</label>
                                </div>
                                <div>{{$d->tgl_bayar}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Periode Bayar</label>
                                </div>
                                <div>{{$d->periode_bayar}}</div>
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
                              <div><img src="{{ asset('image/angsuran/'.$d->bukti_bayar) }}" alt="bukti" width="50%">
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
            <tr>
                <td></td>
                <td><label>Total</label></td>
                <td></td>
                @php
                  $total = 0;
                @endphp
                @foreach($data as $index=>$d)
                  @php
                    $total += $d->nominal;
                  @endphp
                @endforeach
                <td class="text-right">{{$total}}</td>
                <td></td>
              </tr>
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
          <span class="card-title">Form Tambah Angsuran</span>
        </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form action="{{url('angsuran-store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="text" readonly hidden name="id_pinjam" value="{{$id_pinjam}}">
                  @php
                    $anggota = \DB::table('user')->where('kode_hapus', 0)->get();
                  @endphp
                  <div class="form-group">
                    <label for="team">Nama</label>
                    <span class="text-danger">*</span>
                    <select required readonly class="form-control" name="id_user">
                      <option value="">Select Anggota</option>
                      @foreach($anggota as $a)
                      <option value="{{$a->id}}" {{$pinjaman->id_user == $a->id?'selected':''}}>{{$a->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-6 form-group">
                      <label for="team">Periode Bayar</label>
                      <span class="text-danger">*</span>
                      <input required class="form-control" type="text" placeholder="ex:Pembayarn ke-3" name="periode_bayar">
                    </div>
                    <div class="col-6 form-group">
                      <label for="team">Tanggal Bayar</label>
                      <span class="text-danger">*</span>
                      <input required class="form-control" type="date" name="tgl_bayar">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 form-group">
                      <label for="team">Nominal</label>
                      <span class="text-danger">*</span>
                      <input class="form-control" required type="text" name="nominal" placeholder="ex:250000">
                    </div>
                    <div class="col-6 form-group">
                      <label for="team">Bukti Bayar</label>
                      <input class="form-control" type="file" name="bukti_bayar">
                    </div>
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