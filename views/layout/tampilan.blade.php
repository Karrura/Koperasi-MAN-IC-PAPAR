
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', 'Koperasi MAN Insan Cendekia')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free')}}/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins')}}/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins')}}/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins')}}/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist')}}/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins')}}/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins')}}/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins')}}/summernote/summernote-bs4.css">
  <!-- Google Font: Lato -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,400i,700">

  <link href="{{asset('image/needed')}}/logo.png" rel="shortcut icon">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('/')}}" class="nav-link">Dashboard</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        @if (session()->get('foto')!=null)
        <img class="rounded-circle" src="{{ asset('image/foto/'.session()->get('foto')) }}" alt="foto" width="50px" height="50px" style="padding: 5px;">
        @else
        <img class="rounded-circle" src="{{ asset('image/needed/logo.png') }}" alt="foto" width="50px" height="50px" style="padding: 5px;">
        @endif
      
                <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                
                    <li>
                        <!-- class="dropdown user user-menu" -->
                        <marqueee>
                            <a class="nav-item">{{session()->get('nama')}}</br>{{session()->get('role')}}</a>
                        </marqueee>
                    </li>
                </div>
            </ul>
    </nav>
    <!-- /.navbar -->

    @include('layout.sidebar')
    

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">
        @yield('content')
        <div class="container-fluid">
          <!-- Main row -->
          

          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('layout.footer')
  </div>
  <!-- ./wrapper -->

  @include('layout.script')
  </body>
</html>
