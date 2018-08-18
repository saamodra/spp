<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tahun;
use App\Kelas;
use App\Siswa;
use App\Kas;
use App\Transaksi;
use Carbon\Carbon;
use DB;

class LaporanController extends Controller
{
    public function tahun(){
      $tahun = Tahun::orderBy('status', 'ASC')->orderBy('tahun', 'DESC')->get();

      return view('laporan.reportTahun')->with('tahun', $tahun);
    }

    public function kelas(){
      $kelas = Kelas::select('kelas', 'jurusan', 'letter', DB::raw('count(siswa.id_siswa) as jumlah_murid'))->leftJoin('siswa', 'kelas.id_kelas', '=', 'siswa.id_kelas')->groupBy('kelas.id_kelas', 'kelas.kelas', 'kelas.jurusan', 'kelas.letter')->get();

      return view('laporan.reportKelas')->with('kelas', $kelas);
    }

    public function siswa(){
      $siswa = Siswa::leftJoin('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->leftJoin('tahun', 'siswa.id_tahun', '=', 'tahun.id_tahun')->get();

      return view('laporan.reportSiswa')->with('siswa', $siswa);
    }

    public function kas()
    {
        $data = Kas::leftJoin('users', 'kas.operator', '=', 'users.id')->orderBy('kas.created_at', 'DESC')->paginate();
        $masuk = Kas::leftJoin('users', 'kas.operator', '=', 'users.id')->where('pengeluaran', '0')->orderBy('kas.created_at', 'DESC')->paginate();
        $keluar = Kas::leftJoin('users', 'kas.operator', '=', 'users.id')->where('pemasukan', '0')->orderBy('kas.created_at', 'DESC')->paginate();
        $pemasukan = Kas::sum('pemasukan');
        $pengeluaran = Kas::sum('pengeluaran');
        $total_kas = $pemasukan - $pengeluaran;
        return view('laporan.reportKas')->with('data', $data)->with('masuk', $masuk)->with('keluar', $keluar)->with('pemasukan', $pemasukan)->with('pengeluaran', $pengeluaran)->with('total_kas', $total_kas);
    }

    public function kasmasuk()
    {
        $data = Kas::leftJoin('users', 'kas.operator', '=', 'users.id')->where('pengeluaran', '0')->orderBy('kas.created_at', 'DESC')->paginate();
        $pemasukan = Kas::sum('pemasukan');
        return view('laporan.reportKasMasuk')->with('data', $data)->with('pemasukan', $pemasukan);
    }

    public function kaskeluar()
    {
        $data = Kas::leftJoin('users', 'kas.operator', '=', 'users.id')->where('pemasukan', '0')->orderBy('kas.created_at', 'DESC')->paginate();
        $pengeluaran = Kas::sum('pengeluaran');
        return view('laporan.reportKasKeluar')->with('data', $data)->with('pengeluaran', $pengeluaran);
    }

    public function transaksi(){
      $transaksi = Transaksi::leftJoin('users', 'transaksi.operator', '=', 'users.id')
      ->leftJoin('siswa', 'siswa.id_siswa', '=', 'transaksi.id_siswa')
      ->leftJoin('kelas', 'transaksi.id_kelas', '=', 'kelas.id_kelas')
      ->leftJoin('tahun', 'transaksi.id_tahun', '=', 'tahun.id_tahun')
      ->get();

      return view('laporan.reportTransaksi')->with('transaksi', $transaksi);
    }

    public function grafik(){
        $countHarian = DB::table('transaksi')->count(DB::raw('DISTINCT tgl_bayar')); //10
        $limit = 30;
        $skip = $countHarian - $limit;

        $harian = DB::table('transaksi')
        ->select('tgl_bayar', DB::raw('count(*) as total_transaksi'))
        ->groupBy('tgl_bayar')
        ->skip($skip)
        ->take($limit)
        ->get();

        $bulanan = DB::table('transaksi')
        ->select(DB::raw('count(*) as total_transaksi'),DB::raw("CONCAT_WS('-',YEAR(tgl_bayar),MONTH(tgl_bayar)) as bln"))
       ->groupBy('bln')
       ->orderBy('bln', 'ASC')
       ->get();

        $countBulanan = $bulanan->count(DB::raw('DISTINCT bln'));
        $limit = 8;
        $skip = $countHarian - $limit;

        $bulanan = DB::table('transaksi')
        ->select(DB::raw('count(*) as total_transaksi'),DB::raw("CONCAT_WS('-',YEAR(tgl_bayar),MONTH(tgl_bayar)) as bln"))
       ->groupBy('bln')
       ->orderBy('bln', 'ASC')
       ->skip($skip)
       ->take($limit)
       ->get();

        $tahunan = DB::table('transaksi')
        ->select(DB::raw('count(*) as total_transaksi'),DB::raw("CONCAT_WS('-',YEAR(tgl_bayar)) as thn"))
        ->groupBy('thn')
        ->get();


        return view('laporan.reportGrafik')
        ->with('harian', $harian)
        ->with('bulanan', $bulanan)
        ->with('tahunan', $tahunan);
    }
}
