@extends('layouts.main')
@section('page', 'Database')
@section('content-title', 'Database')
@section('content-subtitle', 'Backup & Restore')
@section('database', 'active')
@section('breadcrumb')
  <li class="active"><i class="fa fa-database"></i> Backup & Restore</li>
@endsection
@section('content')
<div class="callout callout-success">
  <h4>Deskripsi</h4>

  <p>Halaman ini digunakan untuk Backup dan Restore Database.</p>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title"> Backup</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
          <div class="alert alert-success" id="message" align="center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('status') }}
            <br><a href="{{ url('download/'. session('file')) }}">Database {{ session('file') }}</a> Disimpan di folder storage/backup
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
        <div class="form-group" align="center">
          <a href="{{ url('/backup') }}" class="btn btn-info" id="backup"> Backup </a>  
        </div>
      </div>
      <div class="overlay" style="display:none" id="loading2">
          <div align="center">
            <a id="loadingtext2"></a>
          </div>
          <i class="fa fa-spinner fa-spin fa-pulse" id="loadicon2"></i>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="box box-warning">
       <div class="box-header">
         <h3 class="box-title"> Restore</h3>
       </div>
       <div class="box-body">
        @if (session('status2'))
          <div class="alert alert-success" id="message" align="center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('status2') }}
          </div>
        @endif
        @if (session('error2'))
          <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ session('error2') }}
          </div>
        @endif
        <form method="post" action="{{ url('/restore') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
            <label>Pilih file sql!</label><br>
            <label class="btn btn-default btn-file">
                Browse <input type="file" name="sql" id="fileinput" style="display: none;">
            </label>
            <span id="selected_filename">No file selected</span>
            <div align="right">
              <button type="submit" class="btn btn-warning" id="restore" disabled=""> Restore</button>
            </div>
        </form>
       </div>
        <div class="overlay" style="display:none" id="loading">
          <div align="center">
            <a id="loadingtext"></a>
          </div>
          <i class="fa fa-spinner fa-spin fa-pulse" id="loadicon"></i>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script type="text/javascript">
    i = 0;
    setInterval(function() {
        i = ++i % 4;
        $("#loadingtext2").html("Database sedang dibackup, Tunggu sebentar"+Array(i+1).join("."));
        $("#loadingtext").html("Database sedang direstore, Tunggu sebentar"+Array(i+1).join("."));
    }, 500);

    $(".alert").fadeTo(2000, 2000).fadeOut(500, function(){
        $(".alert").fadeOut(500);
    });

    $('#fileinput').change(function() {
      $('#selected_filename').text($('#fileinput')[0].files[0].name);
      $("#restore").removeAttr("disabled");
    });

    $("#restore").on("click",function(){
      $("#loading").css("display","block")
    });

    $("#backup").on("click",function(){
      $("#loading2").css("display","block")
    });
  </script>
@endsection