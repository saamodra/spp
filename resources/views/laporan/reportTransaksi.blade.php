@extends('layouts.main')
@section('page', 'Laporan')
@section('content-title', 'Laporan')
@section('content-subtitle', 'Transaksi')
@section('laporan', 'active')
@section('breadcrumb')
  <li><i class="fa fa-bar-chart"></i> Laporan</li>
  <li class="active">Transaksi</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Laporan Transaksi</h3>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped" id="report">
          <thead>
              <tr>
                  <th>#</th>
                  <th>No. Induk</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Tahun</th>
                  <th>Tgl. Bayar</th>
                  <th>Jml. Bayar</th>
                  <th>Operator</th>
              </tr>
          </thead>
          <tbody>
          @foreach($transaksi as $item)
            @php
              $i_jurusan = explode(" ", $item->jurusan);
              $jurusan = "";

              foreach ($i_jurusan as $k) {
                $jurusan .= $k[0];
              }
            @endphp
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->no_induk }}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->kelas.' '.$jurusan.' '.$item->letter }}</td>
                  <td>{{ $item->tahun }}</td>
                  <td>{{ $item->tgl_bayar }}</td>
                  <td>{{ $item->bayar }}</td>
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
            autoWidth: false,
            dom: '<"row"<"col-lg-4"l><"col-lg-4"B><"col-lg-4"f>>rtip',
            buttons: [
            {
                extend : 'excel',
                text : '<i class="fa fa-file-excel-o"></i> Excel',
                title : 'Laporan Transaksi',
                exportOptions: {
                  columns: ':visible',
                }
            },{
                extend : 'pdf',
                text : '<i class="fa fa-file-pdf-o"></i> PDF',
                title : 'Laporan Transaksi',
                exportOptions: {
                  columns: ':visible',
                }
            },{
                extend : 'print',
                text : '<i class="fa fa-print"></i> Print',
                title : 'Laporan Transaksi',
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
              "zeroRecords": "Tidak ada data yang cocok",
              "search": "Pencarian :",
            },
            "columnDefs": [
              { "width": 20, "orderable": false, "targets": [0] }
            ]
        } );
        table.columns.adjust().draw();
        table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    } );
  </script>
@endsection