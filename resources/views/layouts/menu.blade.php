<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>L</b>VL</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{ env('APP_NAME') }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <form action="{{ url('logout') }}" method="post" id="logoutForm">
                @csrf
            </form>
            <li><a href="{{ url('') }}">Presensi depan</a></li>
            <li><a href="#" onclick="document.getElementById('logoutForm').submit()">Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('assets/images/placeholder.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrator</p>
          <small>Admin</small>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU UTAMA</li>
        <li class="treeview{{ request()->is('dashboard') ? ' active':'' }}">
          <a href="{{ url('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
          </a>
        </li>
        <li class="treeview{{ request()->is('data/*') ? ' active':'' }}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Data Master</span>
			      <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ request()->is('data/user') ? 'active':'' }}"><a href="{{ url('data/user') }}"><i class="fa fa-arrow-circle-right"></i> Data User</a></li>
            <li class="{{ request()->is('data/jadwal') ? 'active':'' }}"><a href="{{ url('data/jadwal') }}"><i class="fa fa-arrow-circle-right"></i> Data Jadwal</a></li>
            <li class="{{ request()->is('data/golongan') ? 'active':'' }}"><a href="{{ url('data/golongan') }}"><i class="fa fa-arrow-circle-right"></i> Data Golongan</a></li>
            <li class="{{ request()->is('data/presensi') ? 'active':'' }}"><a href="{{ url('data/presensi') }}"><i class="fa fa-arrow-circle-right"></i> Data Presensi</a></li>
          </ul>
        </li>
        <li class="treeview{{ request()->is('penggajian/*') ? ' active':'' }}">
            <a href="{{ url('penggajian') }}">
              <i class="fa fa-dollar"></i> <span>Penggajian</span>
            </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>