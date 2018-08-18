<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Siswa;
use App\Kelas;
use App\Kas;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Grafik Peminjaman
        $countHarian = DB::table('transaksi')->count(DB::raw('DISTINCT tgl_bayar')); //10
        $limit = 30;
        $skip = $countHarian - $limit;

        $harian = DB::table('transaksi')
        ->select('tgl_bayar', DB::raw('count(*) as total_transaksi'))
        ->groupBy('tgl_bayar')
        ->skip($skip)
        ->take($limit)
        ->get();

        $countSiswa = Siswa::count();
        $countKelas = Kelas::count();
        $pemasukan = Kas::sum('pemasukan');
        $pengeluaran = Kas::sum('pengeluaran');
        $total_kas = $pemasukan - $pengeluaran;

        $recentBill = Transaksi::leftJoin('siswa', 'siswa.id_siswa', '=', 'transaksi.id_siswa')->take(5)->get();
        return view('home')
        ->with('transaksi', $harian)
        ->with('recent', $recentBill)
        ->with('countSiswa', $countSiswa)
        ->with('countKelas', $countKelas)
        ->with('total_kas', $total_kas);
    }
}
