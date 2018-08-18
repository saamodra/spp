@extends('layouts.main')
@section('page', 'Tahun Ajaran')
@section('content-title', 'Master')
@section('content-subtitle', 'Tahun Ajaran')
@section('master', 'active')
@section('tahun', 'active')
@section('breadcrumb')
  <li><i class="fa fa-archive"></i> Master</li>
  <li><a href="{{ url('/tahun') }}"><i class="fa fa-calendar"></i> Tahun</a></li>
  <li class="active">View</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Detail Tahun</h3>
      </div>
      <div class="box-body">
        <a href="{{ url('/tahun') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button></a>
        <a href="{{ url('tahun/edit/' . $tahun->id_tahun) }}" title="Edit Tahun"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

        <form method="POST" action="{{ url('tahun/hapus/' . $tahun->id_tahun) }}" accept-charset="UTF-8" style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-sm" title="Delete Tahun" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
        </form>
        <div class="row">
          <div class="col-md-6">
            <div class="table-responsive">
              <table class="table">
                  <tbody>
                      <tr>
                          <th>ID</th><td>{{ $tahun->id_tahun }}</td>
                      </tr>
                      <tr>
                          <th> Tahun </th><td> {{ $tahun->tahun }} </td>
                      </tr>
                      <tr>
                          <th> Status </th><td> <small class="label bg-{{ $tahun->status == 'Tidak Aktif' ? 'red' : 'green' }}">{{ $tahun->status }}</small> </td>
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