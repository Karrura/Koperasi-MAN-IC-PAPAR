@extends('layout.tampilan')
@section('title', 'Dashboard - Koperasi MAN Insan Cendekia')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <blockquote class="quote-info mt-0">
    <h1 class="text-center"><span style="font-size: 40px">Welcome {{session()->get('nama')}}!</span></h1>
    <p class="text-center">Transaksi Koperasi Syariah MAN IC Padang Pariaman</p>
    <h1 class="text-center mt-0"></h1>
    </blockquote>

    <!-- DATA SIMPANAN -->
    <div class="row d-flex justify-content-center">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>Rp. {{$spokok}}</h3>

            <p>Simpanan Pokok</p>
          </div>
          <div class="icon">
            <!-- <i class="ion ion-stats-bars"></i> -->
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>Rp. {{$swajib}}</h3>

            <p>Simpanan Wajib</p>
          </div>
          <div class="icon">
            <!-- <i class="ion ion-stats-bars"></i> -->
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>Rp. {{$ssukarela}}</h3>

            <p>Simpanan Sukarela</p>
          </div>
          <div class="icon">
            <!-- <i class="ion ion-stats-bars"></i> -->
          </div>
        </div>
      </div>
    </div>

    <!-- DATA PINJAMAN, ANGSURAN, DAN PEMBAYARAN -->
    <div class="card">
      <div class="card-header border-0">
        <h3 class="card-title">Simple Overview</h3>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
          <p class="text-success text-xl">
            <i class="fas fa-hand-holding-usd"></i>
          </p>
          <p class="d-flex flex-column text-right">
            <span class="font-weight-bold">
              <!-- <i class="ion ion-android-arrow-up text-success"></i>  -->
              Rp. {{$spinjaman}}
            </span>
            <span class="text-muted">Total Pinjaman</span>
          </p>
        </div>
        <!-- /.d-flex -->
        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
          <p class="text-warning text-xl">
            <i class="fas fa-file-signature"></i>
          </p>
          <p class="d-flex flex-column text-right">
            <span class="font-weight-bold">
              <!-- <i class="ion ion-android-arrow-up text-warning"></i>  -->
              Rp. {{$sangsuran}}
            </span>
            <span class="text-muted">Total Angsuran</span>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- /.col-md-6 -->
    
@endsection