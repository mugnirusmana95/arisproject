<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo.png')}}" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/iCheck/all.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/custome.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
    .select2-dropdown.increasezindex {
    z-index:99999;
}
  </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="/" class="logo">
      <span class="logo-mini">INV</span>
      <span class="logo-lg">Inventory</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="fa fa-gear"></span> <span class="hidden-xs">Akun</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                @if (Auth::user()->picture==null || Auth::user()->picture=="")
                  @if (Auth::user()->gender==1)
                  <img src="{{asset('images/profile/null_male.jpg')}}" class="img-square" alt="User Image">
                  @elseif (Auth::user()->gender==2)
                    <img src="{{asset('images/profile/null_female.jpg')}}" class="img-square" alt="User Image">
                  @else
                    <img src="{{asset('images/profile/null.jpg')}}" class="img-square" alt="User Image">
                  @endif
                @else
                  <img src="{{asset('images/profile/'.Auth::user()->id.'/'.Auth::user()->picture)}}" class="img-square" alt="User Image">
                @endif
                <p>
                  {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                  <small>
                    @if (Auth::user()->status==1)
                      Administrator
                    @else
                      User
                    @endif
                  </small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Log out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          @if (Auth::user()->picture==null || Auth::user()->picture=="")
            @if (Auth::user()->gender==1)
              <img src="{{asset('images/profile/null_male.jpg')}}" class="img-square" alt="User Image">
            @elseif(Auth::user()->gender==2)
              <img src="{{asset('images/profile/null_female.jpg')}}" class="img-square" alt="User Image">
            @else
              <img src="{{asset('images/profile/null.jpg')}}" class="img-square" alt="User Image">
            @endif
          @else
            <img src="{{asset('images/profile/'.Auth::user()->id.'/'.Auth::user()->picture)}}" class="img-square" alt="User Image">
          @endif
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->first_name}}</p>
          <a>
            @if (Auth::user()->status==1)
              Administrator
            @else
              User
            @endif
          </a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ Request::is('/','/') ? 'active' : ''}}">
          <a href="/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        @if(Auth::user()->status==1)
        <li class="treeview {{ Request::is('master','master/*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-th"></i> <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('master/user','master/user/*') ? 'active' : ''}}"><a href="/master/user"><i class="fa fa-circle-o"></i> Management User</a></li>
            <li class="{{ Request::is('master/barang','master/barang/*') ? 'active' : ''}}"><a href="/master/barang"><i class="fa fa-circle-o"></i> Barang</a></li>
            <li class="{{ Request::is('master/supplier','master/supplier/*') ? 'active' : ''}}"><a href="/master/supplier"><i class="fa fa-circle-o"></i> Supplier</a></li>
            <li class="{{ Request::is('master/gudang','master/gudang/*') ? 'active' : ''}}"><a href="/master/gudang"><i class="fa fa-circle-o"></i> Cabang</a></li>
            <li class="{{ Request::is('master/sales','master/sales/*') ? 'active' : ''}}"><a href="/master/sales"><i class="fa fa-circle-o"></i> Sales</a></li>
          </ul>
        </li>
        @endif

        <li class="treeview {{ Request::is('barang_masuk','barang_masuk/*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-mail-forward"></i> <span>Barang Masuk</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('barang_masuk/supplier','barang_masuk/supplier/*') ? 'active' : ''}}"><a href="/barang_masuk/supplier"><i class="fa fa-circle-o"></i> Dari Supplier</a></li>
            <li class="{{ Request::is('barang_masuk/gudang','barang_masuk/gudang/*') ? 'active' : ''}}"><a href="/barang_masuk/gudang"><i class="fa fa-circle-o"></i> Dari Cabang</a></li>
            <li class="{{ Request::is('barang_masuk/sales','barang_masuk/sales/*') ? 'active' : ''}}"><a href="/barang_masuk/sales"><i class="fa fa-circle-o"></i> Dari Sales</a></li>
            <li class="treeview {{ Request::is('barang_masuk/retur','barang_masuk/retur/*') ? 'active' : ''}}">
              <a href="#">
                <i class="fa fa-circle-o"></i> <span>Retur Barang</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Request::is('barang_masuk/retur/gudang','barang_masuk/retur/gudang/*') ? 'active' : ''}}"><a href="/barang_masuk/retur/gudang"><i class="fa fa-square-o"></i> Dari Cabang</a></li>
              </ul>
            </li>

          </ul>
        </li>

        <li class="treeview {{ Request::is('barang_keluar','barang_keluar/*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-mail-reply"></i> <span>Barang Keluar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('barang_keluar/gudang','barang_keluar/gudang/*') ? 'active' : ''}}"><a href="/barang_keluar/gudang"><i class="fa fa-circle-o"></i> Ke Cabang</a></li>
            <li class="{{ Request::is('barang_keluar/sales','barang_keluar/sales/*') ? 'active' : ''}}"><a href="/barang_keluar/sales"><i class="fa fa-circle-o"></i> Oleh Sales (Toko)</a></li>
          </ul>
        </li>

        <li class="treeview {{ Request::is('laporan','laporan/*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-share"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="treeview {{ Request::is('laporan/barang_masuk','laporan/barang_masuk/*') ? 'active' : ''}}">
              <a href="#"><i class="fa fa-circle-o"></i> Barang Masuk
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Request::is('laporan/barang_masuk/dari_supplier','laporan/barang_masuk/dari_supplier/*') ? 'active' : ''}}"><a href="{{route('report.gisup.index')}}"><i class="fa fa-square-o"></i> Dari Supplier</a></li>
                <li class="{{ Request::is('laporan/barang_masuk/dari_gudang','laporan/barang_masuk/dari_gudang/*') ? 'active' : ''}}"><a href="{{route('report.giware.index')}}"><i class="fa fa-square-o"></i> Dari Cabang</a></li>
                <li class="{{ Request::is('laporan/barang_masuk/dari_sales','laporan/barang_masuk/dari_sales/*') ? 'active' : ''}}"><a href="{{route('report.gisales.index')}}"><i class="fa fa-square-o"></i> Dari Sales</a></li>
              </ul>
            </li>

            <li class="treeview {{ Request::is('laporan/barang_keluar','laporan/barang_keluar/*') ? 'active' : ''}}">
              <a href="#"><i class="fa fa-circle-o"></i> Barang Keluar
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Request::is('laporan/barang_keluar/ke_gudang','laporan/barang_keluar/ke_gudang/*') ? 'active' : ''}}"><a href="{{route('report.goware.index')}}"><i class="fa fa-square-o"></i> Ke Cabang</a></li>
                <li class="{{ Request::is('laporan/barang_keluar/ke_sales','laporan/barang_keluar/ke_sales/*') ? 'active' : ''}}"><a href="{{route('report.gosales.index')}}"><i class="fa fa-square-o"></i> Oleh Sales</a></li>
              </ul>
            </li>

            <li class="{{ Request::is('laporan/hari_ini','laporan/hari_ini/*') ? 'active' : ''}}">
              <a href="/laporan/hari_ini">
                <i class="fa fa-circle-o"></i> <span>Keseluruhan Hari ini</span>
              </a>
            </li>

          </ul>
        </li>

      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    @yield('main')
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('adminlte/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('adminlte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('adminlte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- FLOT CHARTS -->
<script src="{{asset('adminlte/bower_components/Flot/jquery.flot.js')}}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{asset('adminlte/bower_components/Flot/jquery.flot.resize.js')}}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{asset('adminlte/bower_components/Flot/jquery.flot.pie.js')}}"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="{{asset('adminlte/bower_components/Flot/jquery.flot.categories.js')}}"></script>
@yield('js')
</body>
</html>
