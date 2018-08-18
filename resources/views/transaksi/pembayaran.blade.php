@extends('layouts.main')
@section('page', 'Pembayaran')
@section('content-title', 'Transaksi')
@section('content-subtitle', 'Pembayaran')
@section('transaksi', 'active')
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
            <form method="post" action="{{ url('/transaksi/simpan/') }}">
              {{ csrf_field() }}
            <div class="col-md-6">
              <div class="form-group">
                <label>Pencarian</label>
                <select class="cari form-control" name="cari"></select>
              </div>
              <div class="form-group">
                <label>No. Induk</label>
                <input type="text" name="no_induk" class="form-control" id="no_induk" readonly="">
                <input type="text" name="id_siswa" id="id_siswa" hidden="">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" readonly="">
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="kelas" class="form-control" id="kelas" readonly="">
                <input type="text" name="id_kelas" id="id_kelas" hidden="">
              </div>
              <div class="form-group">
                <label>Tahun Ajaran</label>
                <input type="text" name="tahun" class="form-control" id="tahun" readonly="">
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
                <select class="form-control" id="bulan" name="bulan">
                  <option value="" hidden="">Bulan</option>
                  @for ($i = 1; $i < 13 ; $i++)
                    <option value="{{ $i.' Bulan' }}">{{ $i.' Bulan'}}</option>
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
                  <input type="text" name="keringanan" class="form-control" id="keringanan" onkeypress="isNumber(event)" value="0">
                </div>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan"></textarea>
              </div>
              <div class="form-group" align="right">
                <button type="submit" class="btn btn-primary">Bayar</button>
              </div>
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
                text: item.no_induk +' - '+ item.nama,
                nama: item.nama,
                id: item.id_siswa,
                no_induk: item.no_induk,
                tahun: item.tahun,
                id_tahun: item.id_tahun,
                kelas: item.kelas + ' ' + item.jurusan + ' ' + item.letter,
                id_kelas: item.id_kelas,
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
        var id_kelas = $('.cari').select2('data')[0].id_kelas;
        var id_tahun = $('.cari').select2('data')[0].id_tahun;
        spp = $('.cari').select2('data')[0].spp;
        var id = $('.cari').select2('data')[0].id;
        var nama = $('.cari').select2('data')[0].nama;
        $('#id_siswa').val(id);
        $('#no_induk').val(no_induk);
        $('#nama').val(nama);
        $('#kelas').val(kelas);
        $('#id_kelas').val(id_kelas);
        $('#id_tahun').val(id_tahun);
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
          thousandsSeparator: '',
          centsLimit: 0,
        });
      });

      $(document).ready(function() {
        var sppbulan;
        $.ajax({ 
          type: 'GET',
          url: '/pengaturan', 
          dataType: 'json',
          context: document.body,
          async: false,
          success: function (data) 
          {
            sppbulan = data.spp_perbulan;
          }
        });

        //Select Total Bulan
        $('#bulan').on('change', function() {
          $('#total_bayar').each(function( index ) {
            $(this).val(sppbulan * parseInt($('#bulan').val().replace(" Bulan", "")));
            $(this).priceFormat({ prefix: '', thousandsSeparator: '.', centsLimit: 0 });
          });
        });

        $('#keringanan').keyup(function(){
            if (parseInt($('#keringanan').val().replace(".", "")) < parseInt(sppbulan * parseInt($('#bulan').val().replace(" Bulan", "")))) {
              $('#total_bayar').each(function( index ) {
                  $(this).val(parseInt(sppbulan * parseInt($('#bulan').val().replace(" Bulan", ""))) - parseInt($('#keringanan').val().replace(".", "")));
                  $(this).priceFormat({ prefix: '', thousandsSeparator: '.', centsLimit: 0 });
              });
            }else{
              alert('Keringanan tidak boleh lebih dari total bayar!');
              $(this).val('0');
              $('#total_bayar').each(function( index ) {
                $(this).val(parseInt(sppbulan * parseInt($('#bulan').val().replace(" Bulan", ""))));
                $(this).priceFormat({ prefix: '', thousandsSeparator: '.', centsLimit: 0 });
              });
            }
        });
      });
    
      
    });
  </script>
@endsection