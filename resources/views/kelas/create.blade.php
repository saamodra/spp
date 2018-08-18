@extends('layouts.main')
@section('page', 'Kelas')
@section('content-title', 'Master')
@section('content-subtitle', 'Kelas')
@section('master', 'active')
@section('kelas', 'active')
@section('breadcrumb')
  <li><i class="fa fa-archive"></i> Master</li>
  <li><a href="{{ url('kelas') }}"><i class="fa fa-calendar"></i> Kelas</a></li>
  <li class="active">Tambah</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Tambah Kelas</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success">
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
        <div class="col-md-6">
          <form class="form-horizontal" role="form" action="{{ url('/kelas/simpan') }}" method="post">
            {{ csrf_field() }}
              <div class="form-group">
                <label>Tingkat</label>
                <select class="form-control" name="tingkat">
                  @php
                    $kelas = ['X', 'XI', 'XII'];
                  @endphp
                  <option value="" hidden="">Kelas</option>
                  @foreach ($kelas as $list)
                    <option value="{{ $list }}" {{ old('kelas') == $list ? 'selected':'' }}>{{ $list }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Jurusan</label>
                <select name="jurusan" class="form-control">
                  @php
                    $jurusan = ['Rekayasa Perangkat Lunak', 'Teknik Gambar Bangunan', 'Teknik Elektronika Industri', 'Teknik Otomasi Industri', 'Teknik Sepeda Motor', 'Teknik Las', 'Teknik Permesinan', 'Teknik Konstruksi Kayu'];
                  @endphp
                  <option value="" hidden="">Jurusan</option>
                  @foreach ($jurusan as $list)
                    <option value="{{ $list }}" {{ old('jurusan') == $list ? 'selected':'' }}>{{ $list }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Letter</label>
                <select name="letter" class="form-control">
                  @php
                    $letter = ['A', 'B', 'C', 'D'];
                  @endphp
                  <option value="" hidden="">Letter</option>
                  @foreach ($letter as $list)
                    <option value="{{ $list }}" {{ old('letter') == $list ? 'selected':'' }}>{{ $list }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
              </div>
              <div align="right">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <a class="btn btn-danger">Batal</a>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script type="text/javascript">
    function pilihTahun(e) {
      document.getElementById("tahun2").value = "/ " + (parseInt(e.target.value) + 1);
    }
  </script>
@endsection
