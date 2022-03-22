@extends('layout.tampilan')
@section('title', 'Pinjaman - Koperasi MAN Insan Cendekia')
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
          <li class="breadcrumb-item active" href="#" >Laporan Pinjaman</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container"> 
  <div class="container-fluid">
    <div class="card">
      <div class="card-header" style="text-align: center">
        <img src="{{asset('image')}}/needed/logo.png" alt="Logo" class="rounded mx-auto d-block" width="90px" height="auto" style="float: left;">
        <span class="font-weight-bold" style="font-size: 20px">KOPERASI SYARIAH</span><br>
        <span class="font-weight-bold" style="font-size: 20px">MADRASAH ALIYAH NEGERI INSAN CENDEKIA PADANG PARIAMAN</span><br>
        <span class="" style="font-size: 16px">Nagari Sintuk, Kecamatan Sintuk Toboh Gadang, Kabupaten Padang Pariaman, Sumatera Barat</span><br>
        <span class="text-center" style="font-size: 16px">Website : <a href="http://icpp.sch.id">http://icpp.sch.id</a>. Email : <a href="humas@icpp.sch.id">humas@icpp.sch.id</a> Telpon. 0751 7006131</span>
      </div>
    </div>
    <div class="card mb-2">

      <div class="card-body">
        <span class="text-center font-weight-bold" style="font-size: 20px">LAPORAN PEMINJAMAN</span>
          @if(Session::has('success'))
              <div class="alert alert-primary">
                  {{Session::get('success')}}
              </div>
          @endif
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr style="text-align: center;">
                  <th width="5%">No</th>
                  <th width="">Anggota</th>
                  <th width="10%">Tanggal Pinjam</th>
                  <th width="10%">Tanggal Lunas</th>
                  <th width="15%">Status</th>
                  <th width="15%">Nominal Pinjam</th>
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
                <td class="text-center"><span class="badge badge-{{$d->status == 'Lunas'?'success':'danger'}}">{{$d->status}}</span></td>
                <td class="text-right">{{$d->nominal}}</td>  
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
                <td></td>
                <td></td>
                <td class="text-right">{{$total}}</td>
              </tr>
            </table>
          </div>
        </div>   
    </div>
  </div>
</div>
<script type="">
  window.print();
</script>
@endsection