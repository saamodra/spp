@extends('layouts.main')
@section('page', 'Kelas')
@section('content-title', 'Master')
@section('content-subtitle', 'Kelas')
@section('master', 'active')
@section('kelas', 'active')
@section('breadcrumb')
  <li><i class="fa fa-archive"></i> Master</li>
  <li class="active"><i class="fa fa-graduation-cap"></i> Kelas</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Kelas</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
          <div class="alert alert-success" id="message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('status') }}
          </div>
        @endif
        <a href="{{ url('kelas/tambah') }}" id="add_button" class="btn btn-success">Tambah</a>
        <div class="table-responsive">
          <br><table class="table table-bordered table-hover" id="kelasTable">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Kelas</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($kelas as $item)
                  <tr>
                    <td>{{ $loop->iteration . '.' }}</td>
                    <td>{{ $item->kelas .' '. $item->jurusan .' '. $item->letter}}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                        <a href="{{ url('/kelas/show/' . $item->id_kelas) }}"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                        <a href="{{ url('/kelas/edit/' . $item->id_kelas) }}"><button class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('kelas/hapus/' . $item->id_kelas) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(&quot;Anda yakin ingin menghapus data ini?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
        </div>
       </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        var table = $('#kelasTable').DataTable({ 
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "language": {
            "lengthMenu": "_MENU_ Data per halaman",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
            "zeroRecords": "Tidak ada data yang cocok",
            "search": "Pencarian :",
          }
        });
    });
    $("#message").fadeTo(2000, 500).fadeOut(500, function(){
        $("#message").fadeOut(500);
    });
    </script> 
@endsection