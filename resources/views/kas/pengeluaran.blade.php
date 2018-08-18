@extends('layouts.main')
@section('page', 'Pengeluaran | Kas')
@section('content-title', 'Master')
@section('content-subtitle', 'Kas')
@section('master', 'active')
@section('kas', 'active')
@section('breadcrumb')
  <li><i class="fa fa-archive"></i> Master</li>
  <li><a href="{{ url('/kas') }}"><i class="fa fa-money"></i> Kas</a></li>
  <li class="active">Pengeluaran</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Pemasukan</h3>
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
        <form action="{{ url('kas/kaskeluar') }}"" method="POST" role="form">
          {!! csrf_field() !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Pengeluaran</label>
                <div class="input-group">
                  <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" placeholder="Pengeluaran" id="pengeluaran" name="pengeluaran" onkeypress="isNumber(event)" value="{{ old('pengeluaran') }}" required="">
                  <span class="input-group-addon">.00</span>
                </div>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                  <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" value="{{ old('keterangan') }}">
                </div>
              </div>
              <div align="right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('kas') }}"" class="btn btn-danger">Batal</a>  
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script type="text/javascript">
    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
    }
    $(document).ready(function() {
      $('#pengeluaran').each(function( index ) {
        $(this).priceFormat({ 
          prefix: '', 
          thousandsSeparator: '.',
          centsLimit: 0,
        });
      });
    });
  </script>
@endsection
