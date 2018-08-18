@extends('layouts.main')
@section('page', 'Siswa')
@section('content-title', 'Master')
@section('content-subtitle', 'Siswa')
@section('master', 'active')
@section('siswa', 'active')
@section('breadcrumb')
  <li><i class="fa fa-archive"></i> Master</li>
  <li><a href="{{ url('/siswa') }}"><i class="fa fa-user"></i> Siswa</a></li>
  <li class="active">View</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Detail Siswa</h3>
      </div>
      <div class="box-body">
        <a href="{{ url('/siswa') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button></a>
        <a href="{{ url('siswa/edit/' . $siswa->id_siswa) }}" title="Edit siswa"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

        <form method="POST" action="{{ url('siswa/hapus/' . $siswa->id_siswa) }}" accept-charset="UTF-8" style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-sm" title="Delete siswa" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
        </form>
        <div class="row">
          <div class="col-md-6">
            <div class="table-responsive">
              <table class="table">
                  <tbody>
                      <tr>
                          <th> No. Induk</th><td>{{ $siswa->no_induk }}</td>
                      </tr>
                      <tr>
                          <th> Nama</th><td> {{ $siswa->nama }} </td>
                      </tr>
                      <tr>
                          <th> Tempat/Tgl. Lahir</th><td>{{ $siswa->tempat_lahir.', '.date('d-m-Y', strtotime($siswa->tgl_lahir)) }}</td>
                      </tr>
                      <tr>
                          <th> Jenis Kelamin</th><td> {{ $siswa->jenis_kelamin }} </td>
                      </tr>
                      <tr>
                          <th> Agama</th><td> {{ $siswa->agama }} </td>
                      </tr>
                      <tr>
                          <th> Alamat</th><td> {{ $siswa->alamat }} </td>
                      </tr>
                      <tr>
                          <th> Kelas</th><td> {{ $siswa->kelas.' '.$siswa->jurusan.' '.$siswa->letter }} </td>
                      </tr>
                      <tr>
                          <th> Tahun</th><td> {{ $siswa->tahun }} </td>
                      </tr>
                      <tr>
                          <th> Nama Wali</th><td> {{ $siswa->nama_wali }} </td>
                      </tr>
                      <tr>
                          <th> Telepon</th><td> {{ $siswa->telepon }} </td>
                      </tr>
                      <tr>
                          <th> Total SPP</th><td> {{ $siswa->total_spp }} </td>
                      </tr>
                      <tr>
                          <th> Status</th><td> {{ $siswa->status }} </td>
                      </tr>
                      <tr>
                          <th> Keterangan</th><td> {{ $siswa->keterangan }} </td>
                      </tr>
                  </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-6" align="center">
            <img class="img-responsive" style="max-height: 400px;" src="{{ asset('images/' . $siswa->foto) }}" alt="Profil Siswa">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection