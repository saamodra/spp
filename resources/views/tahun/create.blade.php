@extends('layouts.main')
@section('page', 'Tahun Ajaran')
@section('content-title', 'Master')
@section('content-subtitle', 'Tahun Ajaran')
@section('master', 'active')
@section('tahun', 'active')
@section('breadcrumb')
  <li><i class="fa fa-archive"></i> Master</li>
  <li><a href="{{ url('tahun') }}"><i class="fa fa-calendar"></i> Tahun</a></li>
  <li class="active">Tambah</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Tambah Tahun</h3>
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
        <form class="form-horizontal" role="form" action="{{ url('/tahun/simpan') }}" method="post">
          {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-sm-2" for="tahun">Tahun</label>
                <div class="col-sm-10 form-inline">
                    <select class="form-control" id="tahun_add" name="tahun" onchange="pilihTahun(event)">
                      <option value="" hidden="">Tahun</option>
                      @php
                        for ($x = 2005; $x <= date('Y'); $x++) {
                            echo '<option value="'. $x .'">'. $x .'</option>';
                        } 
                      @endphp>
                    </select>
                    <input type="text" name="tahun2" id="tahun2" class="form-control" readonly>
                    <p class="errorTitle text-center alert alert-danger hidden"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="status">Status</label>
                <div class="col-sm-10">
                    <select class="form-control" id="status_add" name="status">
                      <option value="" hidden="">Status</option>
                      <option value="Aktif">Aktif</option>
                      <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                    <p class="errorContent text-center alert alert-danger hidden"></p>
                </div>
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
@endsection
@section('script')
  <script type="text/javascript">
    function pilihTahun(e) {
      document.getElementById("tahun2").value = "/ " + (parseInt(e.target.value) + 1);
    }
  </script>
@endsection
