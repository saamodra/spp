<?php

namespace App\Http\Controllers;

use App\Kas;
use App\Siswa;
use Illuminate\Http\Request;
use Validator;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'tgl1' => 'required',
          'tgl2' => 'required',
        ], [
            'tgl1.required' => 'Harap isi tanggal awal!',
            'tgl2.required' => 'Harap isi tanggal akhir!'
        ]);

        $tgl1 = $request->get('tgl1');
        $tgl2 = $request->get('tgl2');
        $pemasukan = Kas::sum('pemasukan');
        $pengeluaran = Kas::sum('pengeluaran');
        $total_kas = $pemasukan - $pengeluaran;

        if (count($request->all())) {
            if (!empty($tgl1) || !empty($tgl2)) {
                if ($validator->fails()) {
                    $data = Kas::leftJoin('users', 'kas.operator', '=', 'users.id')->orderBy('kas.created_at', 'DESC')->paginate();
                    return view('kas.show')->with('data', $data)->withErrors($validator);
                } else {
                    $data = Kas::leftJoin('users', 'kas.operator', '=', 'users.id')->orderBy('kas.created_at', 'DESC')->whereBetween('tanggal', [$tgl1, $tgl2])->paginate();
                    return view('kas.show')->with('data', $data)->with('total_kas', $total_kas);
                }
            } else{
                $data = Kas::leftJoin('users', 'kas.operator', '=', 'users.id')->orderBy('kas.created_at', 'DESC')->paginate();
                return view('kas.show')->with('data', $data)->with('total_kas', $total_kas);
            }
        } else {
            $data = Kas::leftJoin('users', 'kas.operator', '=', 'users.id')->orderBy('kas.created_at', 'DESC')->paginate();
            return view('kas.show')->with('data', $data)->with('total_kas', $total_kas);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pemasukan()
    {
        return view('kas.pemasukan');
    }

    public function pengeluaran()
    {
        return view('kas.pengeluaran');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kasmasuk(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'pemasukan' => 'required|numeric',
          'keterangan' => 'required',
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return redirect('kas/pemasukan')
                        ->withErrors($validator)
                        ->withInput();
        } else{
            $tambah = new Kas();
            $tambah->tanggal = date("Y-m-d");
            $tambah->pemasukan = str_replace('.', '', $request['pemasukan']);;
            $tambah->pengeluaran = '0';
            $tambah->keterangan = $request['keterangan'];
            $tambah->operator = auth()->user()->id;
            $tambah->save();
            return redirect()->to('/kas')->withStatus('Penambahan Kas Masuk Berhasil!');
        }
    }

    public function kaskeluar(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'pengeluaran' => 'required|numeric',
          'keterangan' => 'required',
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return redirect('kas/pengeluaran')
                        ->withErrors($validator)
                        ->withInput();
        } else{
            $tambah = new Kas();
            $tambah->tanggal = date("Y-m-d");
            $tambah->pemasukan = '0';
            $tambah->pengeluaran = str_replace('.', '', $request['pengeluaran']);
            $tambah->keterangan = $request['keterangan'];
            $tambah->operator = auth()->user()->id;
            $tambah->save();
            return redirect()->to('/kas')->withStatus('Penambahan Kas Keluar Berhasil!');
        }
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
        $kas = Kas::findOrFail($id);

        return view('kas.edit', compact('kas'));
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
        $requestData = $request->all();
        
        $kas = Kas::findOrFail($id);
        $kas->update($requestData);

        return redirect()->to('/kas')->withStatus('Data Berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kas::findOrFail($id)->delete();

        return redirect()->to('/kas')->withStatus('Kas Berhasil dihapus!');
    }

}
