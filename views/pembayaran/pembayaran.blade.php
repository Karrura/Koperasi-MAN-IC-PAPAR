@extends('layout.tampilan')
@section('title', 'Pembayaran - Koperasi MAN Insan Cendekia')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Halaman Pembayaran</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active" href="#" >Pembayaran</li>
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
                  <th width="5%">No</th>
                  <th width="">Siswa</th>
                  <th width="">Tgl Bayar</th>
                  <th width="">Status</th>
                  <th width="">Act</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $index=>$d)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$d->nama}}</td>
                  <td class="text-center">{{$d->tgl_bayar}}</td>
                  <td class="text-center"><span class="badge badge-{{$d->status == 'Menunggu Konfirmasi'?'danger':'success'}}">{{$d->status}}</span></td>
                  <td>
                    <div class="btn-group">
                      @if(session()->get('role')=='Admin')
                      <a href="{{url('pembayaran-verifikasi', $d->id)}}"><button class="btn btn-outline-success btn-sm">Ubah Status</button></a>

                      <a data-toggle="modal" data-target="#detail{{$d->id}}"><button class="btn btn-outline-info btn-sm">Detail</button></a>

                      <a data-toggle="modal" data-target="#edit{{$d->id}}"><button class="btn btn-outline-warning btn-sm">Edit</button></a>

                      <a href="{{url('pembayaran-hapus', $d->id)}}" onclick="return confirm('Hapus data ini?')"><button class="btn btn-outline-danger btn-sm">Hapus</button></a>
                      @elseif(session()->get('role')=='Siswa')
                      <a data-toggle="modal" data-target="#detail{{$d->id}}"><button class="btn btn-outline-info btn-sm">Detail</button></a>
                      @endif
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
                            <form action="{{url('pembayaran-update', $d->id)}}" method="post" enctype="multipart/form-data">
                              @method('put')
                              @csrf
                              @php
                                $siswa = \DB::table('siswa')
                                        ->join('golongan', 'golongan.id', '=', 'siswa.id_golongan')
                                        ->select('siswa.nama', 'siswa.id as sid', 'golongan.id', 'golongan.golongan', 'golongan.uang_makan')
                                        ->where('siswa.kode_hapus', 0)->get();
                              @endphp
                              <div class="form-group">
                                <label for="team">Nama Siswa</label>
                                <span class="text-danger">*</span>
                                <select required class="form-control" id="id_siswa2" name="id_siswa">
                                  <option value="">Select Siswa</option>
                                  @foreach($siswa as $s)
                                  <option value="{{$s->sid}}" {{$d->id_siswa == $s->sid?'selected':''}} 
                                    data-uang="{{$s->uang_makan}}">{{$s->nama}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group">
                                  <label for="team">Uang Makan</label>
                                  <span class="text-danger">*</span>
                                  <input required class="form-control" type="text" id="nominal2" name="nominal" value="{{$d->nominal}}">
                              </div>
                              <div class="row">
                                <div class="col-6 form-group">
                                  <label for="team">Tgl Bayar</label>
                                  <span class="text-danger">*</span>
                                  <input required class="form-control" type="date" value="{{$d->tgl_bayar}}" name="tgl_bayar">
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
                          <label>Detail Pembayaran</label>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-6">
                                  <label>Nama Siswa</label>
                                </div>
                                <div>{{$d->nama}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Nama Orang Tua</label>
                                </div>
                                <div>{{$d->nama_ortu}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Kontak Orang Tua</label>
                                </div>
                                <div>{{$d->nohp_ortu}} <a style="color: green" target="_blank" href="https://api.whatsapp.com/send?phone={{ $d->nohp_ortu}}" ><ion-icon name="logo-whatsapp"></ion-icon></a></div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Nominal</label>
                                </div>
                                <div>{{$d->nominal}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Tgl Bayar</label>
                                </div>
                                <div>{{$d->tgl_bayar}}</div>
                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <label>Status Bayar</label>
                                </div>
                                <div><span class="badge badge-{{$d->status == 'Dikonfirmasi'?'success':'danger'}}">{{$d->status}}</span></div>
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
                              <div><img src="{{ asset('image/pembayaran/'.$d->bukti_bayar) }}" alt="bukti" width="50%">
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
          <span class="card-title">Form Tambah Pembayaran</span>
        </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form action="{{url('pembayaran-store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @php
                    $siswa = \DB::table('siswa')
                            ->join('golongan', 'siswa.id_golongan', '=', 'golongan.id')
                            ->select('siswa.nama', 'siswa.id as sid', 'golongan.id', 'golongan.golongan', 'golongan.uang_makan')
                            ->where('siswa.kode_hapus', 0)->get();
                  @endphp
                  <div class="form-group">
                    <label for="team">Nama Siswa</label>
                    <span class="text-danger">*</span>
                    <select required class="form-control id_siswa" id="id_siswa" name="id_siswa">
                      <option value="">Select Siswa</option>
                      @foreach($siswa as $s)
                      <option value="{{$s->sid}}" data-idsiswa="{{$s->sid}}" data-uang="{{$s->uang_makan}}">{{$s->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                      <label for="team">Uang Makan</label>
                      <span class="text-danger">*</span>
                      <input required class="form-control" type="text" id="nominal" name="nominal">
                  </div>
                  <div class="row">
                    <div class="col-6 form-group">
                      <label for="team">Tgl Bayar</label>
                      <span class="text-danger">*</span>
                      <input required class="form-control" type="date" name="tgl_bayar">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('#id_siswa').on('change', function(){
    const uang = $('#id_siswa option:selected').data('uang');
    const id = $('#id_siswa option:selected').data('idsiswa');

    
    $('[id=nominal]').val(uang);
    $('[id=siswa]').val(id);
  });

  $('#id_siswa2').on('change', function(){
    const uang = $('#id_siswa2 option:selected').data('uang');

    // console.log(uang);
    $('[id=nominal2]').val(uang);
  });
</script>
@endsection