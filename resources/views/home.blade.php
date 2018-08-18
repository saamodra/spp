@extends('layouts.main')

@section('content-title', 'Dashboard')
@section('content-subtitle', 'Home')
@section('dashboard', 'active')
@php
  $transaksiHarian = array();
  $totalTransaksi = array();

  foreach ($transaksi as $item) {
      $transaksiHarian[] = $item->tgl_bayar;
      $totalTransaksi[] = $item->total_transaksi;
  }
  $tgl_bayar = array_map(function ($date) {
      return date('d/m/Y', strtotime($date));
  }, $transaksiHarian);

@endphp
@section('content')
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h2>{{ $countSiswa }}</h2>
        <h4>Siswa</h4>
      </div>
      <div class="icon">
        <i class="fa fa-user"></i>
      </div>
      <a href="{{ url('siswa') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="small-box bg-red">
      <div class="inner">
        <h2>{{ $countKelas }}</h2>
        <h4>Kelas</h4>
      </div>
      <div class="icon">
        <i class="fa fa-graduation-cap"></i>
      </div>
      <a href="{{ url('kelas') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="small-box bg-green">
      <div class="inner">
        <h2>{{ "Rp. " . number_format($total_kas, 2, ',', '.') }}</h2>
        <h4>Saldo Kas</h4>
      </div>
      <div class="icon">
        <i class="fa fa-money"></i>
      </div>
      <a href="{{ url('kas') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="box box-primary">
      <div class="box-body">
        <div class="chart">
          <h4>Transaksi</h4>
          <canvas id="bar-chart1"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Transaksi Baru</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Tgl. Bayar</th>
                <th>Jml. Bayar</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($recent as $item)
              @php
                $tanggal = new DateTime($item->tgl_bayar);
              @endphp
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ date_format($tanggal, 'd-m-Y') }}</td>
                <td>{{ "Rp. " . number_format($item->bayar, 0, ',', '.') }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title"> Backup</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
          <div class="alert alert-success" id="message" align="center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('status') }}
            <br><a href="{{ url('download/'. session('file')) }}">Database {{ session('file') }}</a> Disimpan di folder storage/backup
          </div>
        @endif
        @if ($errors->any())
          <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        <div class="form-group" align="center">
          <a href="{{ url('/backup') }}" class="btn btn-info" id="backup"> Backup </a>  
        </div>
      </div>
      <div class="overlay" style="display:none" id="loading2">
          <div align="center">
            <a id="loadingtext2"></a>
          </div>
          <i class="fa fa-spinner fa-spin fa-pulse" id="loadicon2"></i>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="box box-warning">
       <div class="box-header">
         <h3 class="box-title"> Restore</h3>
       </div>
       <div class="box-body">
        @if (session('status2'))
          <div class="alert alert-success" id="message" align="center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('status2') }}
          </div>
        @endif
        @if (session('error2'))
          <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ session('error2') }}
          </div>
        @endif
        <form method="post" action="{{ url('/restore') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
            <label>Pilih file sql!</label><br>
            <label class="btn btn-default btn-file">
                Browse <input type="file" name="sql" id="fileinput" style="display: none;">
            </label>
            <span id="selected_filename">No file selected</span>
            <div align="right">
              <button type="submit" class="btn btn-warning" id="restore" disabled=""> Restore</button>
            </div>
        </form>
       </div>
        <div class="overlay" style="display:none" id="loading">
          <div align="center">
            <a id="loadingtext"></a>
          </div>
          <i class="fa fa-spinner fa-spin fa-pulse" id="loadicon"></i>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script>
      var barchart1 = document.getElementById('bar-chart1');
      var chart1 = new Chart(barchart1, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($tgl_bayar) ?>,
          datasets: [{
            label: 'Transaksi',
            data: <?php echo json_encode($totalTransaksi) ?>,
            backgroundColor: '#FFAC26',
          }]
        }
      });
  </script>
  <script type="text/javascript">
    i = 0;
    setInterval(function() {
        i = ++i % 4;
        $("#loadingtext2").html("Database sedang dibackup, Tunggu sebentar"+Array(i+1).join("."));
        $("#loadingtext").html("Database sedang direstore, Tunggu sebentar"+Array(i+1).join("."));
    }, 500);

    $(".alert").fadeTo(2000, 2000).fadeOut(500, function(){
        $(".alert").fadeOut(500);
    });

    $('#fileinput').change(function() {
      $('#selected_filename').text($('#fileinput')[0].files[0].name);
      $("#restore").removeAttr("disabled");
    });

    $("#restore").on("click",function(){
      $("#loading").css("display","block")
    });

    $("#backup").on("click",function(){
      $("#loading2").css("display","block")
    });
  </script>
@endsection