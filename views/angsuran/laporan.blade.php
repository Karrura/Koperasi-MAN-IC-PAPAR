@extends('layout.tampilan')
@section('title', 'Laporan Angsuran - Koperasi MAN Insan Cendekia')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Laporan Angsuran</h1>
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
      {{--<div class="card-header text-right">
        <a class="btn btn-info mb-1 text-right" data-toggle="modal" data-target="#modalTambah" style="color: white;">Tambah Data</a>
      </div>--}}
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
                <th width="">Nominal Pinjam</th>
                <th>Total Bayar</th>
                <th width="">Status</th>
                <th width="8%">Act</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index=>$d)
              <tr>
                <td>{{$index+1}}</td>
                <td>{{$d->nama_anggota}}</td>
                <td class="text-right">{{$d->nominal}}</td>
                @php
                  $total = ($d->nominal * 0.05) + $d->nominal;
                @endphp
                <td class="text-right">{{$total}}</td>
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
                <td class="text-center"><span class="badge badge-{{$status == 'Lunas'?'success':'danger'}}">{{$status}}</span></td>
                <td>
                  <div class="btn-group">
                    <a href="{{url('laporan-detailind', $d->id)}}"><button class="btn btn-outline-info btn-sm">Lihat</button></a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>    
    </div>
  </div>
</div>
@endsection