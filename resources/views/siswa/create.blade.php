@extends('layouts.main')
@section('page', 'Siswa')
@section('content-title', 'Master')
@section('content-subtitle', 'Siswa')
@section('master', 'active')
@section('siswa', 'active')
@section('breadcrumb')
  <li><i class="fa fa-archive"></i> Master</li>
  <li><a href="{{ url('siswa') }}"><i class="fa fa-user"></i> Siswa</a></li>
  <li class="active">Tambah</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Tambah Siswa</h3>
      </div>
      <div class="box-body">
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
          <form role="form" action="{{ url('/siswa/simpan') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>No. Induk</label>
                  <input type="text" class="form-control" name="no_induk" value="{{ old('no_induk') }}">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                </div>
                <div class="form-group">
                  <label>Tempat Lahir</label>
                  <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                </div>
                <div class="form-group">
                  <label>Tgl. Lahir</label>
                  <input type="date" class="form-control" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                </div>
                <div class="form-group">
                  <label>Jenis Kelamin</label><br>
                  @foreach ($jenkel as $list)
                    <label id="radio">
                      <input type="radio" name="jenis_kelamin" class="minimal" value="{{ $list }}" {{ old('jenis_kelamin') == $list ? 'checked' : '' }}> {{ $list }}
                    </label>
                  @endforeach
                </div>
                <div class="form-group">
                  <label>Agama</label>
                  <select class="form-control" name="agama">
                    <option hidden="" value="">Agama</option>
                    @foreach ($agama as $list)
                      <option value="{{ $list }}" {{ old('agama') == $list ? 'selected':'' }}>{{ $list }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" id="alamat">{{ old('alamat') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Kelas</label>
                  <select class="form-control" name="id_kelas">
                    <option hidden="" value="">Kelas</option>
                    @foreach ($kelas as $list)
                      <option value="{{ $list->id_kelas }}" {{ old('id_kelas') == $list ? 'selected':'' }}>{{ $list->kelas.' '.$list->jurusan.' '.$list->letter }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tahun</label>
                  <select class="form-control" name="id_tahun">
                    <option hidden="" value="">Tahun</option>
                    @foreach ($tahun as $list)
                      <option value="{{ $list->id_tahun }}" {{ old('id_tahun') == $list ? 'selected':'' }}>{{ $list->tahun }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Nama Wali</label>
                  <input type="text" name="nama_wali" class="form-control" value="{{ old('nama_wali') }}">
                </div>
                <div class="form-group">
                  <label>Telepon</label>
                  <input type="text" name="telepon" class="form-control" onkeypress="return isNumber(event)" value="{{ old('telepon') }}">
                </div>
                <div class="form-group">
                  <label>Keringanan</label>
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" id="keringanan" onkeypress="return isNumber(event)">
                  </div>
                </div>
                <div class="form-group">
                  <label>Total SPP</label>
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" name="total_spp" class="form-control" id="total" value="{{ number_format(2700000, 0, '', '.') }}" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" name="keterangan" id="keterangan">{{ old('keterangan') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Foto</label><br>
                  <label class="btn btn-default btn-file">
                      Browse <input type="file" name="foto" id="fileinput" style="display: none;">
                  </label>
                  <span id="selected_filename">No file selected</span>
                </div>
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
    $('input[type="radio"].minimal').iCheck({
      radioClass   : 'iradio_square-green',
    });
    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
    }
    $(document).ready(function() {
      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });
    });
    $('#keringanan').each(function( index ) {
        $(this).priceFormat({ 
          prefix: '', 
          thousandsSeparator: '',
          centsLimit: 0,
        });
    });
    $('#keringanan').bind("enterKey",function(e){
      if ($('#keringanan').val() != "") {
        $('#total').each(function( index ) {
            $(this).val(2700000 - parseInt($('#keringanan').val()));
            $(this).priceFormat({ prefix: '', thousandsSeparator: '.', centsLimit: 0 });
        });
      }
      $('#keterangan').focus();
    });
    $('#keringanan').keyup(function(e){
        if(e.keyCode == 13)
        {
            $(this).trigger("enterKey");
        }
    });
    $('#fileinput').change(function() {
      $('#selected_filename').text($('#fileinput')[0].files[0].name);
    });
  </script>
@endsection
