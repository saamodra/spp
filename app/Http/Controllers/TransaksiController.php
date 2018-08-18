<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Response;
use DB;
use App\Siswa;
use App\Kas;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::get();
        return view('transaksi.pembayaran')->with('transaksi', $transaksi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadData(Request $request)
    {
      if ($request->has('q')) {
        $cari = $request->q;
        $data = Siswa::leftJoin('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->leftJoin('tahun', 'siswa.id_tahun', '=', 'tahun.id_tahun')->where('nama', 'LIKE', "%$cari%")->where('siswa.status', 'Belum Lunas')->get();
        return response()->json($data);
      }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bayar = str_replace('.', '', $request['total_bayar']);

        //Transaksi
        $transaksi = new Transaksi;
        $transaksi->id_siswa = $request['id_siswa'];
        $transaksi->id_kelas = $request['id_kelas'];
        $transaksi->id_tahun = $request['id_tahun'];
        $transaksi->bayar = $bayar;
        $transaksi->tgl_bayar = date('Y-m-d');
        $transaksi->keterangan = $request['keterangan'];
        $transaksi->operator = auth()->user()->id;
        $transaksi->save();


        //Siswa
        DB::table('siswa')->where('id_siswa', $request['id_siswa'] )->update(['total_spp' => DB::raw("total_spp-$bayar")]);

        //Kas
        $kas = new Kas();
        $kas->tanggal = date("Y-m-d");
        $kas->pemasukan = $bayar;
        $kas->pengeluaran = '0';
        $kas->keterangan = $request['bulan'].' Pembayaran '. $request['nama'];
        $kas->operator = auth()->user()->id;
        $kas->save();

        return back()->withStatus('Pembayaran berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
