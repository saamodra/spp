@extends('layouts.main')
@section('page', 'Pembayaran')
@section('content-title', 'Transaksi')
@section('content-subtitle', 'Pembayaran')
@section('pembayaran', 'active')
@section('styletambahan')
  {{-- expr --}}
@endsection
@section('breadcrumb')
  <li class="active"><i class="fa fa-credit-card-alt"></i>  Pembayaran</li>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Pembayaran</h3>
        </div>
        <div class="box-body">
          @if (session('status'))
            <div class="alert alert-success" id="message">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ session('status') }}
            </div>
          @endif
          <div class="row">
            <div class="col-md-12">
              
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Pencarian</label>
                <select class="cari form-control" name="cari"></select>
              </div>
              <div class="form-group">
                <label>No. Induk</label>
                <input type="text" name="" class="form-control" id="no_induk" readonly="">
                <input type="text" name="id_siswa" hidden="" id="id_siswa">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="" class="form-control" id="nama" readonly="">
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="" class="form-control" id="kelas" readonly="">
                <input type="text" name="id_kelas" id="id_kelas" hidden="" readonly="">
              </div>
              <div class="form-group">
                <label>Tahun Ajaran</label>
                <input type="text" name="" class="form-control" id="tahun" readonly="">
                <input type="text" name="id_tahun" id="id_tahun" hidden="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Total Tunggakan</label>
                <div class="input-group">
                  <span class="input-group-addon">Rp.</span>
                  <input type="text" id="spp" class="form-control" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label>SPP Bulan</label>
                <select class="form-control" id="bulan">
                  <option hidden=""></option>
                  @for ($i = 1; $i < 13 ; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
                </select>
              </div>
              <div class="form-group">
                <label>Jumlah Pembayaran</label>
                <div class="input-group">
                  <span class="input-group-addon">Rp.</span>
                  <input type="text" name="total_bayar" class="form-control" id="total_bayar" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label>Keringanan</label>
                <div class="input-group">
                  <span class="input-group-addon">Rp.</span>
                  <input type="text" name="keringanan" class="form-control" id="keringanan" onkeypress="isNumber(event)">
                </div>
              </div>
            </div>
          </div>
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
    $('.cari').select2({
      placeholder: 'Cari...',
      ajax: {
        url: '/cari',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.nama,
                id: item.id_siswa,
                no_induk: item.no_induk,
                tahun: item.tahun,
                kelas: item.kelas,
                spp: item.total_spp
              }
            })
          };
        },
        cache: true
      }
    });
    $(document).ready(function() {
      var spp;
      //Cari
      $('.cari').on('change', function() {
        var id = $('.cari').select2('data')[0].id;
        var no_induk = $('.cari').select2('data')[0].no_induk;
        var tahun = $('.cari').select2('data')[0].tahun;
        var kelas = $('.cari').select2('data')[0].kelas;
        spp = $('.cari').select2('data')[0].spp;
        var id = $('.cari').select2('data')[0].id;
        var nama = $('.cari').select2('data')[0].text;
        $('#id_siswa').val(id);
        $('#no_induk').val(no_induk);
        $('#nama').val(nama);
        $('#kelas').val(kelas);
        $('#tahun').val(tahun);
        $('#spp').val(spp);
        $('#spp').each(function( index ) {
          $(this).priceFormat({ 
            prefix: '', 
            thousandsSeparator: '.',
            centsLimit: 0,
          });
        });
      });

      $('#keringanan').each(function( index ) {
        $(this).priceFormat({ 
          prefix: '', 
          thousandsSeparator: '.',
          centsLimit: 0,
        });
      });
      //Select Total Bulan
      $('#bulan').on('change', function() {
        $('#total_bayar').each(function( index ) {
          $(this).val(225000 * parseInt($('#bulan').val()));
          $(this).priceFormat({ prefix: '', thousandsSeparator: '.', centsLimit: 0 });
        });
      });

      //Keringanan Enter Key
      $('#keringanan').bind("enterKey",function(e){
        if ($('#keringanan').val() != "" && $('#keringanan').val() < $('#total_bayar').val()) {
          $('#total_bayar').each(function( index ) {
              $(this).val(parseInt($('#total_bayar').val().replace(".", "")) - parseInt($('#keringanan').val()));
              $(this).priceFormat({ prefix: '', thousandsSeparator: '.', centsLimit: 0 });
          });
        }else{
          alert('Keringanan tidak boleh lebih dari total bayar!');
        }
      });

      $('#keringanan').keyup(function(e){
          if ($('#keringanan').val() != "" && $('#keringanan').val() < $('#total_bayar').val()) {
            $('#total_bayar').each(function( index ) {
                $(this).val(parseInt(225000 * parseInt($('#bulan').val())) - parseInt($('#keringanan').val().replace(".", "")));
                $(this).priceFormat({ prefix: '', thousandsSeparator: '.', centsLimit: 0 });
            });
          }else{
            alert('Keringanan tidak boleh lebih dari total bayar!');
          }
          if(e.keyCode == 13)
          {
              $(this).trigger("enterKey");
          }
      });
    });
  </script>
@endsection