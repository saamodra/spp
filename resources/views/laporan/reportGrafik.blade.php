@extends('layouts.main')
@section('page', 'Laporan')
@section('content-title', 'Laporan')
@section('content-subtitle', 'Grafik Transaksi')
@section('laporan', 'active')
@section('breadcrumb')
  <li><i class="fa fa-bar-chart"></i> Laporan</li>
  <li class="active">Grafik Transaksi</li>
@endsection
@section('content')
@php
  $tanggalHarian = array();
  $totalHarian = array();

  $tanggalBulanan = array();
  $totalBulanan = array();

  $tanggalTahunan = array();
  $totalTahunan = array();

  foreach ($harian as $item) {
      $tanggalHarian[] = $item->tgl_bayar;
      $totalHarian[] = $item->total_transaksi;
  }
  foreach ($bulanan as $item) {
    $tanggalBulanan[] = $item->bln;
    $totalBulanan[] = $item->total_transaksi;
  }
  $tglHarian = array_map(function ($date) {
      return date('d/m/Y', strtotime($date));
  }, $tanggalHarian);

  $tglBulanan = array_map(function ($date) {
      return date('m/Y', strtotime($date));
  }, $tanggalBulanan);

  foreach ($tahunan as $item) {
    $tanggalTahunan[] = $item->thn;
    $totalTahunan[] = $item->total_transaksi;
  }
@endphp

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Grafik Transaksi</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success" id="message">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('status') }}
        </div>
        @endif
        <div class="col-md-12">
          <div class="chart">
            <h4>Harian</h4>
            <canvas id="bar-chart1"></canvas>
          </div>
        </div>
        <div class="col-md-6">
          <div class="chart">
            <h4>Bulanan</h4>
            <canvas id="bar-chart2"></canvas>
          </div>
        </div>
        <div class="col-md-6">
          <div class="chart">
            <h4>Tahunan</h4>
            <canvas id="bar-chart3"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script>
      var barchart1 = document.getElementById('bar-chart1');
      barchart1.height = 100;
      var chart1 = new Chart(barchart1, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($tglHarian) ?>, // Merubah data tanggal menjadi format JSON
          datasets: [{
            label: 'Transaksi',
            data: <?php echo json_encode($totalHarian) ?>,
            backgroundColor: '#00A65A',
          }]
        }
      });
      var barchart2 = document.getElementById('bar-chart2');
      var chart2 = new Chart(barchart2, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($tglBulanan) ?>, // Merubah data tanggal menjadi format JSON
          datasets: [{
            label: 'Transaksi',
            data: <?php echo json_encode($totalBulanan) ?>,
            backgroundColor: '#FFAC26',
          }]
        }
      });
      var barchart3 = document.getElementById('bar-chart3');
      var chart3 = new Chart(barchart3, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($tanggalTahunan) ?>, // Merubah data tanggal menjadi format JSON
          datasets: [{
            label: 'Transaksi',
            data: <?php echo json_encode($totalTahunan) ?>,
            backgroundColor: '#00ACD6',
          }]
        }
      });  

  </script>
@endsection
