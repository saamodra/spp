@extends('layouts.main')
@section('page', 'Laporan')
@section('content-title', 'Laporan')
@section('content-subtitle', 'Siswa')
@section('laporan', 'active')
@section('breadcrumb')
  <li><i class="fa fa-bar-chart"></i> Laporan</li>
  <li class="active">Siswa</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Laporan Siswa</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <p id="selectFilterKelas"><label><b>Filter Kelas</b></label><br></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <p id="selectFilterTahun"><label><b>Filter Tahun</b></label><br></p>
            </div>
          </div>
        </div>
        <table class="table table-bordered table-striped" id="report">
          <thead>
              <tr>
                  <th class="all">#</th>
                  <th class="all">No. Induk</th>
                  <th class="all">Nama</th>
                  <th class="all">Tempat/Tgl. Lahir</th>
                  <th class="all">Jenis Kelamin</th>
                  <th class="none">Agama</th>
                  <th class="none">Alamat</th>
                  <th class="all">Kelas</th>
                  <th class="all">Tahun Ajaran</th>
                  <th class="none">Nama Wali</th>
                  <th class="none">Telepon</th>
                  <th class="all">Tunggakan SPP</th>
                  <th class="none">Status</th>
                  <th class="none">Keterangan</th>
              </tr>
          </thead>
          <tbody>
          @foreach($siswa as $item)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->no_induk }}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->tempat_lahir.', '.date('d-m-Y', strtotime($item->tgl_lahir)) }}</td>
                  <td>{{ $item->jenis_kelamin }}</td>
                  <td>{{ $item->agama }}</td>
                  <td>{{ $item->alamat }}</td>
                  <td>{{ $item->kelas.' '.$item->jurusan.' '.$item->letter }}</td>
                  <td>{{ $item->tahun }}</td>
                  <td>{{ $item->nama_wali }}</td>
                  <td>{{ $item->telepon }}</td>
                  <td>{{ "Rp. " . number_format($item->total_spp, 0, ',', '.') }}</td>
                  <td>{{ $item->status }}</td>
                  <td>{{ $item->keterangan }}</td>
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
            responsive: true,
            autoWidth: false,
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
            initComplete: function() {
              var column = this.api().column(7);
              var column2 = this.api().column(8);

              var select = $('<select class="filter form-control"><option value=""></option></select>')
                .appendTo('#selectFilterKelas')
                .on('change', function() {
                  var val = $(this).val();
                  column.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
                });
              var select2 = $('<select class="filter form-control"><option value=""></option></select>')
                .appendTo('#selectFilterTahun')
                .on('change', function() {
                  var val = $(this).val();
                  column2.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
                });

              column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
              });
              column2.data().unique().sort().each(function(d, j) {
                select2.append('<option value="' + d + '">' + d + '</option>');
              });
            },
            "columnDefs": [
              { "width": 20, "targets": [0] }
            ]
        } );
        table.columns.adjust().draw();
        table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    } );
  </script>
@endsection