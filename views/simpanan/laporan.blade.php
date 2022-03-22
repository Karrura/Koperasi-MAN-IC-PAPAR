@extends('layout.tampilan')
@section('title', 'Laporan Simpanan - Koperasi MAN Insan Cendekia')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Laporan Simpanan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active" href="#" >Laporan Simpanan</li>
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
            <a class="btn btn-primary mb-1 text-right ml-2" href="{{url('laporan-simpanan-detailPdf', $bulan)}}" style="color: white; float: right">Cetak</a>
        </div>
        @if(session()->get('role')!='Anggota')
        <div class="card-header">
          <form class="form-group" action="{{url('laporan-simpanan-search')}}" method="GET" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="form-group col-6">
                    <select class="form-control" name="bulan" required>
                      <option value="">Pilih Bulan</option>
                      @php
                        $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                      @endphp
                      @for($i=1; $i<=12; $i++)
                        <option value="{{$i}}">{{$bulan[$i-1]}}</option>
                      @endfor
                    </select>
                </div> 
              </div>
              <div class="text">
                  <button type="submit" class="btn btn-primary">Next</button>
              </div>
          </form>
        </div>    
        @endif
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
                  <th width="">Nominal</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $index=>$d)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$d->nama_anggota}}</td>
                  <td>{{$d->nama_jenis}}</td>
                  <td>{{$d->tgl_simpan}}</td>
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
                <td class="text-right">{{$total}}</td>
              </tr>
            </table>
          </div>
        </div>    
      </div>
    </div>
</div>

@endsection