@extends('layouts.main')
@section('page', 'Laporan')
@section('content-title', 'Laporan')
@section('content-subtitle', 'Kelas')
@section('laporan', 'active')
@section('breadcrumb')
  <li><i class="fa fa-bar-chart"></i> Laporan</li>
  <li class="active">Kelas</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Laporan Kelas</h3>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped" id="report">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Kelas</th>
                  <th>Jumlah Murid</th>
              </tr>
          </thead>
          <tbody>
          @foreach($kelas as $item)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->kelas.' '.$item->jurusan.' '.$item->letter }}</td>
                  <td>{{ $item->jumlah_murid }}</td>
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
                title : 'Laporan Anggota',
                exportOptions: {
                  columns: ':visible',
                }
            },{
                extend : 'pdf',
                text : '<i class="fa fa-file-pdf-o"></i> PDF',
                title : 'Laporan Anggota',
                exportOptions: {
                  columns: ':visible',
                }
            },{
                extend : 'print',
                text : '<i class="fa fa-print"></i> Print',
                title : 'Laporan Anggota',
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

        table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    } );
  </script>
@endsection