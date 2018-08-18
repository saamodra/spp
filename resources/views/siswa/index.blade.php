@extends('layouts.main')
@section('page', 'Siswa')
@section('content-title', 'Master')
@section('content-subtitle', 'Siswa')
@section('master', 'active')
@section('siswa', 'active')
@section('breadcrumb')
  <li><i class="fa fa-archive"></i> Master</li>
  <li class="active"><i class="fa fa-user"></i> Siswa</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Siswa</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
          <div class="alert alert-success" id="message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('status') }}
          </div>
        @endif
        <a href="{{ url('siswa/tambah') }}" id="add_button" class="btn btn-success">Tambah</a>
        <div class="table-responsive">
          <br><table class="table table-bordered table-hover" id="siswaTable">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>No. Induk</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Tahun</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($siswa as $item)
                  <tr>
                    <td>{{ $loop->iteration . '.' }}</td>
                    <td>{{ $item->no_induk }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kelas.' '.$item->jurusan.' '.$item->letter }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>
                        <a href="{{ url('/siswa/show/' . $item->id_siswa) }}" title="View Anggota"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                        <a href="{{ url('/siswa/edit/' . $item->id_siswa) }}" title="Edit Anggota"><button class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('siswa/hapus/' . $item->id_siswa) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Anggota" onclick="return confirm(&quot;Anda yakin ingin menghapus data ini?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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
        var table = $('#siswaTable').DataTable({ 
          "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
          "language": {
            "lengthMenu": "_MENU_ Data per halaman",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
            "zeroRecords": "Tidak ada data yang cocok",
            "search": "Pencarian :",
          }
        });
        $("#message").fadeTo(2000, 500).fadeOut(500, function(){
            $("#message").fadeOut(500);
        });
    });
    </script> 
@endsection