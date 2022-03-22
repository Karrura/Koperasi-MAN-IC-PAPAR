<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="https://icpp.sch.id/" target="_blank" class="brand-link center">
    <span class="brand-text font-weight-light"><b>MAN IC Padang Pariaman</b></span>
  </a>
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="card" style="background: transparent;">
      <div class="image">
        <img src="{{asset('image')}}/needed/logo.png" alt="Logo" class="rounded mx-auto d-block" width="50%" height="auto">
      </div>
      <div class="card-footer">
        
      </div>
      {{--<div class="info">
        <a href="#" class="d-block">{{session()->get('role')}}</a>
      </div>--}}
    </div>
      @if (session()->get('role')=='Admin')
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{url('/')}}" class="nav-link {{Request::is('dashboard') ? 'active' : ''}}">
            <p>
              <i class="nav-icon fas fa-home"></i>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview {{Request::is('user-*','jenis-*','golongan-*','siswa-*') ? 'menu-open' : ''}}">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-th"></i> -->
              <!-- <i class="fas fa-angle-left nav-icon"></i> -->
            <p>
              DATA MASTER
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('user-data')}}" class="nav-link {{Request::is('user-*') ? 'active' : ''}}">
                <i class="far fa-address-book nav-icon"></i>
                <p>Anggota Koperasi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('siswa-data')}}" class="nav-link {{Request::is('siswa-*') ? 'active' : ''}}">
                <i class="fas fa-users nav-icon"></i>
                <p>Siswa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('golongan-data')}}" class="nav-link {{Request::is('golongan-*') ? 'active' : ''}}">
                <i class="fas fa-sort-alpha-down nav-icon"></i>
                <p>Golongan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('jenis-data')}}" class="nav-link {{Request::is('jenis-*') ? 'active' : ''}}">
                <i class="fas fa-money-bill nav-icon"></i>
                <p>Jenis Simpanan</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview {{Request::is('simpanan-*', 'pinjaman-*', 'angsuran-*', 'pembayaran-*') ? 'menu-open' : ''}}">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-th"></i> -->
              <!-- <i class="fas fa-angle-left nav-icon"></i> -->
            <p>
              TRANSAKSI
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('simpanan-data')}}" class="nav-link {{Request::is('simpanan-*') ? 'active' : ''}}">
                <i class="fas fa-piggy-bank nav-icon"></i>
                <p>Simpanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('pinjaman-data')}}" class="nav-link {{Request::is('pinjaman-*') ? 'active' : ''}}">
                <i class="fas fa-hand-holding-usd nav-icon"></i>
                <p>Pinjam</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('angsuran-data')}}" class="nav-link {{Request::is('angsuran-*') ? 'active' : ''}}">
                <i class="fas fa-file-signature nav-icon"></i>
                <p>Angsuran</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('pembayaran-data')}}" class="nav-link {{Request::is('pembayaran-*') ? 'active' : ''}}">
                <i class="fas fa-wallet nav-icon"></i>
                <p>Pembayaran</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview {{Request::is('laporan-*','laporan-simpanan','laporan-pinjaman','laporan-angsuran','laporan-pembayaran') ? 'menu-open' : ''}}">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-th"></i> -->
              <!-- <i class="fas fa-angle-left nav-icon"></i> -->
            <p>
              LAPORAN
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('laporan-simpanan')}}" class="nav-link {{Request::is('laporan-simpanan') ? 'active' : ''}}">
                <i class="fas fa-file-import nav-icon"></i>
                <p>Simpanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('laporan-pinjaman')}}" class="nav-link {{Request::is('laporan-pinjaman') ? 'active' : ''}}">
                <i class="fas fa-file-export nav-icon"></i>
                <p>Peminjaman</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('laporan-angsuran')}}" class="nav-link {{Request::is('laporan-angsuran') ? 'active' : ''}}">
                <i class="fas fa-file-contract nav-icon"></i>
                <p>Angsuran</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('laporan-pembayaran')}}" class="nav-link {{Request::is('laporan-pembayaran') ? 'active' : ''}}">
                <i class="fas fa-file-invoice-dollar nav-icon"></i>
                <p>Pembayaran</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{url('/logout')}}" class="nav-link">
            <p>
              <i class="nav-icon fas fa-sign-out-alt"></i>
              LOGOUT
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
    @elseif (session()->get('role')=='Anggota')
        <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{url('/')}}" class="nav-link {{Request::is('dashboard') ? 'active' : ''}}">
            <p>
              <i class="nav-icon fas fa-home"></i>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview {{Request::is('laporan-simpanan', 'laporan-pinjaman', 'laporan-angsuran') ? 'menu-open' : ''}}">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-th"></i> -->
              <!-- <i class="fas fa-angle-left nav-icon"></i> -->
            <p>
              LAPORAN
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('laporan-simpanan')}}" class="nav-link {{Request::is('laporan-simpanan') ? 'active' : ''}}">
                <i class="fas fa-file-import nav-icon"></i>
                <p>Simpanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('laporan-pinjaman')}}" class="nav-link {{Request::is('laporan-pinjaman') ? 'active' : ''}}">
                <i class="fas fa-file-export nav-icon"></i>
                <p>Peminjaman</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('laporan-angsuran')}}" class="nav-link {{Request::is('laporan-angsuran') ? 'active' : ''}}">
                <i class="fas fa-file-contract nav-icon"></i>
                <p>Angsuran</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{url('/logout')}}" class="nav-link">
            <p>
              <i class="nav-icon fas fa-sign-out-alt"></i>
              LOGOUT
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
    @elseif (session()->get('role')=='Atasan')
        <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{url('/')}}" class="nav-link {{Request::is('dashboard') ? 'active' : ''}}">
            <p>
              <i class="nav-icon fas fa-home"></i>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview {{Request::is('laporan-pembayaran', 'laporan-simpanan', 'laporan-pinjaman', 'laporan-angsuran') ? 'menu-open' : ''}}">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-th"></i> -->
              <!-- <i class="fas fa-angle-left nav-icon"></i> -->
            <p>
              LAPORAN
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('laporan-simpanan')}}" class="nav-link {{Request::is('laporan-simpanan') ? 'active' : ''}}">
                <i class="fas fa-file-import nav-icon"></i>
                <p>Simpanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('laporan-pinjaman')}}" class="nav-link {{Request::is('laporan-pinjaman') ? 'active' : ''}}">
                <i class="fas fa-file-export nav-icon"></i>
                <p>Peminjaman</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('laporan-angsuran')}}" class="nav-link {{Request::is('laporan-angsuran') ? 'active' : ''}}">
                <i class="fas fa-file-contract nav-icon"></i>
                <p>Angsuran</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('laporan-pembayaran')}}" class="nav-link {{Request::is('laporan-pembayaran') ? 'active' : ''}}">
                <i class="fas fa-file-invoice-dollar nav-icon"></i>
                <p>Pembayaran</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{url('/logout')}}" class="nav-link">
            <p>
              <i class="nav-icon fas fa-sign-out-alt"></i>
              LOGOUT
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
    @else
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{url('/dashboard-siswa')}}" class="nav-link {{Request::is('dashboard') ? 'active' : ''}}">
            <p>
              <i class="nav-icon fas fa-home"></i>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview {{Request::is('simpanan-*', 'pinjaman-*', 'angsuran-*', 'pembayaran-*') ? 'menu-open' : ''}}">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-th"></i> -->
              <!-- <i class="fas fa-angle-left nav-icon"></i> -->
            <p>
              TRANSAKSI
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('pembayaran-data')}}" class="nav-link {{Request::is('pembayaran-*') ? 'active' : ''}}">
                <i class="fas fa-wallet nav-icon"></i>
                <p>Pembayaran</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview {{Request::is('laporan-pembayaran') ? 'menu-open' : ''}}">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-th"></i> -->
              <!-- <i class="fas fa-angle-left nav-icon"></i> -->
            <p>
              LAPORAN
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('laporan-pembayaran')}}" class="nav-link {{Request::is('laporan-pembayaran') ? 'active' : ''}}">
                <i class="fas fa-file-invoice-dollar nav-icon"></i>
                <p>Pembayaran</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{url('/logout')}}" class="nav-link">
            <p>
              <i class="nav-icon fas fa-sign-out-alt"></i>
              LOGOUT
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
    @endif
  </div>
  <!-- /.sidebar -->
</aside>