@extends('layouts.main')
@section('page', 'Kelas')
@section('content-title', 'Master')
@section('content-subtitle', 'Kelas')
@section('master', 'active')
@section('kelas', 'active')
@section('breadcrumb')
  <li><i class="fa fa-archive"></i> Master</li>
  <li><a href="{{ url('/kelas') }}"><i class="fa fa-graduation-cap"></i> Kelas</a></li>
  <li class="active">View</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Detail Kelas</h3>
      </div>
      <div class="box-body">
        <a href="{{ url('/kelas') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button></a>
        <a href="{{ url('kelas/edit/' . $kelas->id_tahun) }}" title="Edit kelas"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

        <form method="POST" action="{{ url('kelas/hapus/' . $kelas->id_tahun) }}" accept-charset="UTF-8" style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-sm" title="Delete kelas" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
        </form>
        <div class="row">
          <div class="col-md-6">
            <div class="table-responsive">
              <table class="table">
                  <tbody>
                      <tr>
                          <th>ID</th><td>{{ $kelas->id_tahun }}</td>
                      </tr>
                      <tr>
                          <th> Kelas </th><td> {{ $kelas->kelas.' '.$kelas->jurusan.' '.$kelas->letter }} </td>
                      </tr>
                      <tr>
                          <th> Keterangan </th><td> {{ $kelas->keterangan }} </td>
                      </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection