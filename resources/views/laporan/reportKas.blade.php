@extends('layouts.main')
@section('page', 'Laporan')
@section('content-title', 'Laporan')
@section('content-subtitle', 'Kas')
@section('laporan', 'active')
@section('breadcrumb')
  <li><i class="fa fa-bar-chart"></i> Laporan</li>
  <li class="active">Kas</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Aliran Kas</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success" id="message">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('status') }}
        </div>
        @endif
        <div class="row">
          <div class="col-md-4">
            <h4>Sisa Saldo Kas : {{ "Rp. " . number_format($total_kas, 2, ',', '.') }}</h4>
          </div>
        </div>
          <br><table class="table table-bordered table-striped" id="report">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Tanggal</th>
                      <th>Pemasukan</th>
                      <th>Pengeluaran</th>
                      <th>Keterangan</th>
                      <th>Operator</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($data as $item)
                @php
                  $tanggal = new DateTime($item->tanggal);
                @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date_format($tanggal, 'd-m-Y') }}</td>
                        <td>{{ "Rp. " . number_format($item->pemasukan, 0, ',', '.') }}</td>
                        <td>{{ "Rp. " . number_format($item->pengeluaran, 0, ',', '.') }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->name }}</td>
                    </tr>
                @endforeach
              </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Pemasukan</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success" id="message">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('status') }}
        </div>
        @endif
        <div class="row">
          <div class="col-md-4">
            <h4>Total Pemasukan : {{ "Rp. " . number_format($pemasukan, 2, ',', '.') }}</h4>
          </div>
        </div>
        <br><table class="table table-bordered table-striped" id="report2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Pemasukan</th>
                    <th>Keterangan</th>
                    <th>Operator</th>
                </tr>
            </thead>
            <tbody>
              @foreach($masuk as $item)
              @php
                $tanggal = new DateTime($item->tanggal);
              @endphp
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ date_format($tanggal, 'd-m-Y') }}</td>
                      <td>{{ "Rp. " . number_format($item->pemasukan, 0, ',', '.') }}</td>
                      <td>{{ $item->keterangan }}</td>
                      <td>{{ $item->name }}</td>
                  </tr>
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Pengeluaran</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success" id="message">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('status') }}
        </div>
        @endif
        <div class="row">
          <div class="col-md-4">
            <h4>Total Pengeluaran : {{ "Rp. " . number_format($pengeluaran, 2, ',', '.') }}</h4>
          </div>
        </div>
        <br><table class="table table-bordered table-striped" id="report3">
            <thead>
                <tr>
                  <th>#</th>
                  <th>Tanggal</th>
                  <th>Pengeluaran</th>
                  <th>Keterangan</th>
                  <th>Operator</th>
                </tr>
            </thead>
            <tbody>
              @foreach($keluar as $item)
              @php
                $tanggal = new DateTime($item->tanggal);
              @endphp
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date_format($tanggal, 'd-m-Y') }}</td>
                    <td>{{ "Rp. " . number_format($item->pengeluaran, 0, ',', '.') }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ $item->name }}</td>
                  </tr>
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
        var table = $('#report').DataTable( {
            dom: '<"row"<"col-lg-4"l><"col-lg-4"B><"col-lg-4"f>>rtip',
            buttons: [
            {
                extend : 'excel',
                text : '<i class="fa fa-file-excel-o"></i> Excel',
                title : 'Laporan Kas',
                exportOptions: {
                  columns: ':visible',
                }
            },{
                extend : 'pdf',
                text : '<i class="fa fa-file-pdf-o"></i> PDF',
                title : 'Laporan Kas',
                exportOptions: {
                  columns: ':visible',
                }
            },{
                extend : 'print',
                text : '<i class="fa fa-print"></i> Print',
                title : 'Laporan Kas',
                exportOptions: {
                  columns: ':visible',
                }
            },{
              extend : 'colvis',
              text : '<i class="fa fa-eye"></i>'
            }
            ],
            "language": {
              "lengthMenu": "_MENU_ Data per halaman",
              "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
              "zeroRecords": "Tidak ada data",
              "search": "Pencarian :",
            },
            "columnDefs": [
              { "width": 20, "orderable": false, "targets": [0] }
            ]
        } );
      var table2 = $('#report2').DataTable( {
            dom: '<"row"<"col-lg-4"l><"col-lg-4"B><"col-lg-4"f>>rtip',
            buttons: [
            {
                extend : 'excel',
                text : '<i class="fa fa-file-excel-o"></i> Excel',
                title : 'Laporan Kas',
                exportOptions: {
                  columns: ':visible',
                }
            },{
                extend : 'pdf',
                text : '<i class="fa fa-file-pdf-o"></i> PDF',
                title : 'Laporan Kas',
                exportOptions: {
                  columns: ':visible',
                }
            },{
                extend : 'print',
                text : '<i class="fa fa-print"></i> Print',
                title : 'Laporan Kas',
                exportOptions: {
                  columns: ':visible',
                }
            },{
              extend : 'colvis',
              text : '<i class="fa fa-eye"></i>'
            }
            ],
            "language": {
              "lengthMenu": "_MENU_ Data per halaman",
              "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
              "zeroRecords": "Tidak ada data",
              "search": "Pencarian :",
            },
            "columnDefs": [
              { "width": 20, "orderable": false, "targets": [0] }
            ]
        } );
        var table3 = $('#report3').DataTable( {
            dom: '<"row"<"col-lg-4"l><"col-lg-4"B><"col-lg-4"f>>rtip',
            buttons: [
            {
                extend : 'excel',
                text : '<i class="fa fa-file-excel-o"></i> Excel',
                title : 'Laporan Kas',
                exportOptions: {
                  columns: ':visible',
                }
            },{
                extend : 'pdf',
                text : '<i class="fa fa-file-pdf-o"></i> PDF',
                title : 'Laporan Kas',
                exportOptions: {
                  columns: ':visible',
                }
            },{
                extend : 'print',
                text : '<i class="fa fa-print"></i> Print',
                title : 'Laporan Kas',
                exportOptions: {
                  columns: ':visible',
                }
            },{
              extend : 'colvis',
              text : '<i class="fa fa-eye"></i>'
            }
            ],
            "language": {
              "lengthMenu": "_MENU_ Data per halaman",
              "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
              "zeroRecords": "Tidak ada data",
              "search": "Pencarian :",
            },
            "columnDefs": [
              { "width": 20, "orderable": false, "targets": [0] }
            ]
        } );

        table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
        table2.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
        table3.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    } );

  </script>
@endsection