<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('page', 'Pembayaran SPP')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  {{-- Mixed CSS --}}
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/toastr.min.css') }}">
  <link href="{{ asset('/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/buttons.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.dataTables.min.css') }}">
  @yield('addstyle')
  <!-- Google Font -->
  <link rel="stylesheet" href="{{ asset('/css/fonts.css') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('home') }}" class="logo">
      <span class="logo-mini"><b></b>SPP</span>
      <span class="logo-lg"><b>Pembayaran</b> SPP</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li>
              <a href="#" class="pengaturan" {{-- data-toggle="modal" data-target="#modal-pengaturan" --}}><i class="fa fa-cogs"></i> Pengaturan</a>
            </li>
            @if (auth()->check())
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset('images/'. auth()->user()->avatar) }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ auth()->user()->name }}</span>
                </a>

                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ asset('images/'. auth()->user()->avatar) }}" class="img-circle" alt="User Image">

                    <p>
                      {{ auth()->user()->name }} - Web Developer
                      <small>Member sejak {{ date_format(auth()->user()->created_at, 'd-m-Y') }}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="row">
                      <div class="col-xs-4 text-center">
                        <a href="#">Followers</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Sales</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Friends</a>
                      </div>
                    </div>
                    <!-- /.row -->
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
            <li>
              <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
            </li>
            {{-- <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li> --}}
            @else
            <li>
              <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login</a>
            </li>
            @endif
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('images/'.auth()->user()->avatar) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ auth()->user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="@yield('dashboard', '')">
          <a href="{{ url('/home') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="@yield('database', '')">
          <a href="{{ url('/database') }}">
            <i class="fa fa-database"></i> <span>Database</span>
          </a>
        </li>
        <li class="@yield('identitas', '')">
          <a href="{{ url('/identitas') }}">
            <i class="fa fa-address-card"></i> <span>Identitas</span>
          </a>
        </li>
        <li class="treeview @yield('master', '')">
          <a href="#">
            <i class="fa fa-archive"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield('tahun', '')">
              <a href="{{ url('/tahun') }}">
                <i class="fa fa-calendar"></i> <span>Tahun</span>
              </a>
            </li>
            <li class="@yield('kelas', '')">
              <a href="{{ url('/kelas') }}">
                <i class="fa fa-graduation-cap"></i> <span>Kelas</span>
              </a>
            </li>
            <li class="@yield('siswa', '')">
              <a href="{{ url('/siswa') }}">
                <i class="fa fa-user"></i> <span>Siswa</span>
              </a>
            </li>
            <li class="@yield('mutasi', '')">
              <a href="{{ url('/siswa/mutasi') }}">
                <i class="fa fa-exchange"></i> <span>Mutasi Siswa</span>
              </a>
            </li>
            <li class="@yield('kas', '')">
              <a href="{{ url('/kas') }}">
                <i class="fa fa-money"></i> <span>Kas</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="@yield('transaksi', '')">
          <a href="{{ url('/transaksi') }}">
            <i class="fa fa-handshake-o"></i> <span>Transaksi</span>
          </a>
        </li>
        <li class="treeview @yield('laporan', '')">
          <a href="#">
            <i class="fa fa-bar-chart"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('laporan/tahun') }}"><i class="fa fa-circle-o"></i> Tahun</a></li>
            <li><a href="{{ url('laporan/kelas') }}"><i class="fa fa-circle-o"></i> Kelas</a></li>
            <li><a href="{{ url('laporan/siswa') }}"><i class="fa fa-circle-o"></i> Siswa</a></li>
            <li><a href="{{ url('laporan/kas') }}"><i class="fa fa-circle-o"></i> Kas</a></li>
            <li><a href="{{ url('laporan/transaksi') }}"><i class="fa fa-circle-o"></i> Transaksi</a></li>
            <li><a href="{{ url('laporan/grafik') }}"><i class="fa fa-circle-o"></i> Grafik Transaksi</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('content-title', 'Title')
        <small>@yield('content-subtitle', 'Subtitle')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        @yield('breadcrumb', '')
      </ol>
    </section>
  
    <!-- Main content -->
    <section class="content">
      @yield('content', '')
    </section>
  </div>
    <!-- /.content -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="#">Samodra</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->
{{-- Modal Pengaturan --}}
<div class="modal fade" id="modal-pengaturan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pengaturan</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
          {{ csrf_field() }}
            <div class="form-group">
              <label class="control-label col-sm-3" for="tahun">SPP per Bulan</label>
              <div class="col-sm-9 form-inline">
                <div class="input-group">
                  <span class="input-group-addon">Rp.</span>
                  <input type="text" name="spp" id="sppbulan" class="form-control">
                </div>
                <p class="errorTitle text-center alert alert-danger hidden"></p>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary savep">Simpan Perubahan</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- AdminLTE for demo purposes -->
<script src="{{ mix('/js/app.js') }}"></script>
<script src="{{ asset('/js/toastr.min.js') }}"></script>
<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('/js/jszip.min.js') }}"></script>
<script src="{{ asset('/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('/js/jquery.priceFormat.min.js') }}"></script>
<script src="{{ asset('/js/Chart.min.js') }}"></script>
<script type="text/javascript">
  //Pengaturan
  $(document).on('click', '.pengaturan', function() {
      $('#modal-pengaturan').modal('show');
      $('#sppbulan').each(function( index ) {
        $(this).priceFormat({ 
          prefix: '', 
          thousandsSeparator: '.',
          centsLimit: 0,
        });
      });
      $.ajax({ 
        type: 'GET',
        url: '/pengaturan', 
        dataType: 'json',
        success: function (data) 
        {
          $('#sppbulan').val(data.spp_perbulan); 
          $('#sppbulan').priceFormat({ 
            prefix: '', 
            thousandsSeparator: '.',
            centsLimit: 0,
          });
        }
      });
      
  });
  $('.modal-footer').on('click', '.savep', function() {
      $.ajax({
          type: 'POST',
          url: 'pengaturan/update',
          data: {
              '_token': $('input[name=_token]').val(),
              'spp': $("#sppbulan").val(),
          },
          success: function(data) {
              $('.errorTitle').addClass('hidden');
              $('.errorContent').addClass('hidden');

              if ((data.errors)) {
                  setTimeout(function () {
                      $('#modal-pengaturan').modal('show');
                      toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                  }, 500);

                  if (data.errors.title) {
                      $('.errorTitle').removeClass('hidden');
                      $('.errorTitle').text(data.errors.title);
                  }
                  if (data.errors.content) {
                      $('.errorContent').removeClass('hidden');
                      $('.errorContent').text(data.errors.content);
                  }
              } else {
                  toastr.success('Pengaturan berhasil disimpan!', 'Berhasil', {timeOut: 5000});
                  $('#modal-pengaturan').modal('toggle');
              }
          }
      });
  });
</script>
@yield('script', '')
</body>
</html>
