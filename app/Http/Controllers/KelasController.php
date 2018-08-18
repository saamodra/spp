<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Kelas;
use App\Tahun;

class KelasController extends Controller
{
    protected $rules =
    [
        'tingkat' => 'required',
        'jurusan' => 'required',
        'letter' => 'required'
    ];

    protected $pesan = 
    [
        'required' => 'Kolom :attribute tidak boleh kosong'
    ];

    public function index()
    {
        $kelas = Kelas::orderBy('kelas', 'ASC')->get();
        return view('kelas.index')->with('kelas', $kelas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->pesan);
        if ($validator->fails()) {
            return redirect('kelas/create')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            $add = new Kelas;
            $add->kelas = $request['tingkat'];
            $add->jurusan = $request['jurusan'];
            $add->letter = $request['letter'];
            $add->keterangan = $request['keterangan'];
            $add->save();
            return redirect()->to('/kelas')->withStatus('Penambahan Kelas Berhasil!');
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
        $kelas = Kelas::findOrFail($id);

        return view('kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);

        return view('kelas.edit', compact('kelas'));
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
        $validator = Validator::make($request->all(), $this->rules, $this->kelas);
        if ($validator->fails()) {
            return redirect('kelas/edit')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $kelas = Kelas::findOrFail($id);
            $kelas->kelas = $request['tingkat'];
            $kelas->jurusan = $request['jurusan'];
            $kelas->letter = $request['letter'];
            $kelas->keterangan = $request['keterangan'];
            $kelas->update();
            return redirect()->to('/kelas')->withStatus('Data Berhasil diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();

        return redirect()->to('/kelas')->withStatus('Kelas Berhasil dihapus!');
    }
}
