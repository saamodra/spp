<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Tahun;
use Illuminate\Support\Facades\DB;

class TahunController extends Controller
{
    protected $rules =
    [
        'tahun' => 'required',
        'status' => 'required',
    ];

    protected $pesan = 
    [
        'required' => 'Kolom :attribute Tidak Boleh Kosong',
    ];

    public function index()
    {
        $tahun = Tahun::orderBy('status', 'ASC')->orderBy('tahun', 'DESC')->get();
        return view('tahun.index')->with('tahun', $tahun);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahun.create');
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
            return redirect('tahun/tambah')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $add = new Tahun;
            $add->tahun = $request['tahun'] . str_replace(' ', '', $request['tahun2']);
            $add->status = $request['status'];
            $add->save();
            return redirect()->to('/tahun')->withStatus('Penambahan Tahun Berhasil!');
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
        $tahun = Tahun::findOrFail($id);

        return view('tahun.show', compact('tahun'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tahun = Tahun::findOrFail($id);

        return view('tahun.edit', compact('tahun'));
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
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return redirect('tahun/edit')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            if ($request['status'] == 'Aktif') {
                DB::table('tahun')->update(['status' => 'Tidak Aktif']);
                $tahun = Tahun::findOrFail($id);
                $tahun->tahun = $request['tahun'] . str_replace(' ', '', $request['tahun2']);
                $tahun->status = $request['status'];
                $tahun->update();
            } else {
                $tahun = Tahun::findOrFail($id);
                $tahun->tahun = $request['tahun'] . str_replace(' ', '', $request['tahun2']);
                $tahun->status = $request['status'];
                $tahun->update();
            }

            return redirect()->to('/tahun')->withStatus('Data Berhasil diupdate!');
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
        Tahun::findOrFail($id)->delete();

        return redirect()->to('/tahun')->withStatus('Tahun Berhasil dihapus!');
    }
}
