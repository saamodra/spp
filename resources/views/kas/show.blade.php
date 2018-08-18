@extends('layouts.main')
@section('page', 'Kas')
@section('content-title', 'Master')
@section('content-subtitle', 'Kas')
@section('master', 'active')
@section('kas', 'active')
@section('breadcrumb')
  <li><i class="fa fa-archive"></i> Master</li>
  <li class="active"><a href="{{ url('/kas') }}"><i class="fa fa-money"></i> Kas</a></li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Kas</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success" id="message">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('status') }}
        </div>
        @endif
        @if ($errors->any())
          <div class="alert alert-danger" id="message2">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        <div class="row">
          <div class="col-md-4">
            <a href="{{ url('kas/pemasukan') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Pemasukan</a>
            <a href="{{ url('kas/pengeluaran') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Pengeluaran</a>
          </div>
          <div class="col-md-4">
            <h4>Total Kas : {{ "Rp. " . number_format($total_kas, 2, ',', '.') }}</h4>
          </div>
          <div class="col-md-4">
            <form method="GET" action="{{ url('kas') }}" accept-charset="UTF-8" class="form-inline">
                <input type="date" class="form-control" name="tgl1" placeholder="Pencarian" value="{{ request('tgl1') }}">
                <label> - </label>
                <input type="date" class="form-control" name="tgl2" placeholder="Pencarian" value="{{ request('tgl2') }}">
                <button class="btn btn-success" type="submit" name="btnsearch">
                      <i class="fa fa-search"></i>
                </button>
            </form>
          </div>
        </div>
        <div class="table-responsive">
          <br><table class="table table-bordered table-striped" id="kasTable">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Tanggal</th>
                      <th>Pemasukan</th>
                      <th>Pengeluaran</th>
                      <th>Keterangan</th>
                      <th>Operator</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
              @if ($data->isEmpty())
                <tr>
                  <td colspan="7">{{ 'Tidak ada data!' }}</td>
                </tr>
              @else
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
                        <td>
                            <a href="{{ url('/kas/edit/' . $item->id_kas) }}" title="Edit Kas"><button class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                            <form method="POST" action="{{ url('/kas/hapus/' . $item->id_kas) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Kas" onclick="return confirm(&quot;Anda yakin ingin menghapus data ini?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
              @endif
              
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
    $(document).ready(function() {
      $("#message").fadeTo(2000, 500).fadeOut(500, function(){
        $("#message").fadeOut(500);
      });
      $("#message2").fadeTo(2000, 500).fadeOut(500, function(){
        $("#message2").fadeOut(500);
      });
    });
    $(document).ready(function(){
      var table = $('#kasTable').DataTable({ 
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "language": {
            "lengthMenu": "_MENU_ Data per halaman",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
            "zeroRecords": "Tidak ada data yang cocok",
            "search": "Pencarian :",
          }
        });
    });
  </script>
@endsection
