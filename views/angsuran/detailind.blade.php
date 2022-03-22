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
      <div class="card-header text-right">
        <a class="btn btn-primary mb-1 text-right ml-2" href="{{url('laporan-detailPdf/'.$id_pinjam)}}" style="color: white; float: right">Cetak</a>
        <a class="btn btn-success mb-1 text-right ml-2" href="{{url('laporan-angsuran')}}" style="color: white; float: right">Kembali</a>
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
            <label>Total Bayar</label>
          </div>
          @php
            $total = ($data_user->nominal * 0.05) + $data_user->nominal;
          @endphp
          <div class="col-3">{{$total}}</div>
        </div>
        <div class="row">
          <div class="col-6">
            <label>Status</label>
          </div>
          <div class="col-3"><span class="badge badge-{{$data_user->status == 'Lunas'?'success':'danger'}}">{{$data_user->status}}</span></div>
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
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index=>$d)
              <tr>
                <td>{{$index+1}}</td>
                <td>{{$d->periode_bayar}}</td>
                <td class="text-center">{{$d->tgl_bayar}}</td>
                <td class="text-center">{{$d->nominal}}</td>
              </tr>
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
              </tr>
          </table>
        </div>
      </div>    
    </div>
  </div>
</div>
@endsection