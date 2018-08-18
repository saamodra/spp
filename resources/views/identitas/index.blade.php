@extends('layouts.main')
@section('page', 'Identitas')
@section('content-title', 'Identitas')
@section('content-subtitle', 'Instansi')
@section('identitas', 'active')
@section('breadcrumb')
  <li><i class="fa fa-archive"></i> Identitas</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Identitas Instansi</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
          <div class="alert alert-success" id="message">
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
          <form action="{{ url('/identitas/update') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Instansi</label>
                  <input type="text" class="form-control" name="nama_instansi" value="{{ $identitas->nama_instansi }}">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat">{{ $identitas->alamat }}</textarea>
                </div>
                <div class="form-group">
                  <label>Kota</label>
                  <input type="text" class="form-control" name="kota" value="{{ $identitas->kota }}">
                </div>
                <div class="form-group">
                  <label>Telepon</label>
                  <input type="text" class="form-control" name="telp" value="{{ $identitas->telp }}">
                </div>
                <div class="form-group">
                  <label>Website</label>
                  <input type="text" class="form-control" name="website" value="{{ $identitas->website }}">
                </div>
                <div class="form-group">
                  <label>Keuangan</label>
                  <input type="text" class="form-control" name="keuangan" value="{{ $identitas->keuangan }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" align="center">
                  <img class="img-responsive" id="showlogo" style="max-height: 300px;" src="{{ asset('images/' . $identitas->logo) }}" alt="Profil">
                </div>
                <div class="form-group">
                  <label>Logo</label><br>
                  <label class="btn btn-default btn-file" id="browse">
                      Browse <input type="file" name="logo" id="fileinput" style="display: none;">
                  </label>
                  <span id="selected_filename">No file selected</span>
                </div>
              </div>
            </div>
              <div>
                <button class="btn btn-warning" type="button" id="edit">Edit</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn btn-danger" type="button" id="batal">Batal</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#showlogo').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
    }
    $(window).on( "load", function() {
        $("input").prop("readonly", true);
        $("textarea").prop("readonly", true);
        $("#browse").prop("disabled", true);
        $("#fileinput").prop("disabled", true);
    });
    $(document).ready(function() {
      $("#edit").click(function(){            
          $("input").prop("readonly", false);
          $("textarea").prop("readonly", false);
          $("#browse").prop("disabled", false);
          $("#fileinput").prop("disabled", false);
      });
      $("#batal").click(function(){            
          $("input").prop("readonly", true);
          $("textarea").prop("readonly", true);
          $("#browse").prop("disabled", true);
          $("#fileinput").prop("disabled", true);
      });
    });
    $("#fileinput").change(function () {
        readURL(this);
        $('#selected_filename').text($('#fileinput')[0].files[0].name);
    });

    $("#message").fadeTo(2000, 500).fadeOut(500, function(){
        $("#message").fadeOut(500);
    });
</script>
@endsection
