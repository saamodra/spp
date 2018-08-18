@extends('layouts.main')
@section('page', 'Siswa')
@section('content-title', 'Mutasi')
@section('content-subtitle', 'Siswa')
@section('mutasi', 'active')
@section('breadcrumb')
  <li><a href="{{ url('siswa') }}"><i class="fa fa-calendar"></i> Siswa</a></li>
  <li class="active">Mutasi</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Mutasi Siswa</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success" id="alertSuccess">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('status') }}
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
        <form role="form" action="{{ url('siswa/mutasi/save') }}" method="post">
          {{ csrf_field() }}
          <div class="row">
              <div class="form-group col-md-3">
                <p id="selectFilterKelas"><label><b>Filter Kelas</b></label><br></p>
              </div>
              <div class="form-group col-md-3">
                <label>Tujuan Mutasi</label>
                <select class="form-control" name="id_kelas">
                  @foreach ($kelas as $item)
                    <option value="{{ $item->id_kelas }}">{{ $item->kelas.' '.$item->jurusan.' '.$item->letter }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
                <p id="selectFilterTahun"><label><b>Filter Tahun</b></label><br></p>
              </div>
              <div class="form-group col-md-3">
                <label>Tahun Ajaran Aktif</label>
                @foreach ($tahun as $item)
                  <input type="text" name="id_tahun" class="form-control" value="{{ $item->tahun }}" readonly="">
                @endforeach
              </div>
          </div>
          
          <div>
            <table class="table table-bordered table-hover" id="siswaTable">
              <thead>
                <tr>
                  <th class="no-sort"><input type="checkbox" id="checkAll"></th>
                  <th>No. Induk</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Tahun</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($siswa as $item)
                  <tr>
                    <td><input type="checkbox" name="id_siswa[]" id="id_siswa" value="{{ $item->id_siswa }}"></td>
                    <td>{{ $item->no_induk }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kelas.' '.$item->jurusan.' '.$item->letter }}</td>
                    <td>{{ $item->tahun }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="form-group" align="center">
              <button class="btn btn-primary" type="submit">Proses Mutasi</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#siswaTable').DataTable({
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "language": {
            "lengthMenu": "_MENU_ Data per halaman",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
            "zeroRecords": "Tidak ada data yang cocok",
            "search": "Pencarian :",
          },
          "deferRender": true,
          initComplete: function() {
            var column = this.api().column(3);
            var column2 = this.api().column(4);
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
            { "width": 20, "orderable": false, "targets": 'no-sort' }
          ]
      });

      $("#checkAll").change(function () {
          $("input:checkbox").prop('checked', $(this).prop("checked"));
      });

      $("#alertSuccess").fadeTo(2000, 500).fadeOut(500, function(){
          $("#alertSuccess").fadeOut(500);
      });
    } );
  </script>
@endsection
