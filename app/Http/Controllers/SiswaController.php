<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Kelas;
use App\Tahun;
use Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $agama = ['Islam', 'Kristen', 'Katholik', 'Hindu', 'Buddha', 'Konghuchu'];

    protected $jenkel = ['Laki-Laki', 'Perempuan'];

    protected $rules = [
        'no_induk' => array('required', 'regex:/[.\/0-9]/'),
        'nama' => 'required|string',
        'tempat_lahir' => 'required|string',
        'tgl_lahir' => 'required',
        'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
        'agama' => 'required',
        'alamat' => 'required',
        'id_kelas' => 'required',
        'id_tahun' => 'required',
        'nama_wali' => 'required|string',
        'telepon' => array('required', 'regex:/[+()|\s|0-9]{10}/'),
        'total_spp' => 'required',
    ];

    protected $pesan = [
        'required' => 'Kolom :attribute tidak boleh kosong.',
        'telepon.regex' => 'Kolom telepon harus diisi dengan nomor telepon.',
        'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong.',
        'required|string' => 'Kolom :attribute harus diisi dengan huruf',
    ];

    public function index()
    {
      $id_tahun = Tahun::select('id_tahun')->where('status', 'Aktif')->first();
      $siswa = Siswa::leftJoin('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->leftJoin('tahun', 'siswa.id_tahun', '=', 'tahun.id_tahun')->where('siswa.id_tahun', $id_tahun->id_tahun)->get();
      $kelas = Kelas::all();
      $tahun = Tahun::all();
      return view('siswa.index')->with('siswa', $siswa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::orderBy('kelas', 'ASC')->orderBy('jurusan', 'ASC')->orderBy('letter', 'ASC')->get();
        $tahun = Tahun::orderBy('tahun', 'DESC')->get();
        return view('siswa.create')->with('agama', $this->agama)->with('jenkel', $this->jenkel)->with('kelas', $kelas)->with('tahun', $tahun);
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
            return redirect('siswa/tambah')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $file       = $request->file('foto');
            $fileName   = $file->getClientOriginalName();

            $add = new Siswa;
            $add->no_induk = $request['no_induk'];
            $add->nama = $request['nama'];
            $add->tempat_lahir = $request['tempat_lahir'];
            $add->tgl_lahir = $request['tgl_lahir'];
            $add->jenis_kelamin = $request['jenis_kelamin'];
            $add->agama = $request['agama'];
            $add->alamat = $request['alamat'];
            $add->id_kelas = $request['id_kelas'];
            $add->id_tahun = $request['id_tahun'];
            $add->nama_wali = $request['nama_wali'];
            $add->telepon = $request['telepon'];
            $add->total_spp = str_replace('.', '', $request['total_spp']);
            $add->keterangan = $request['keterangan'];
            $request->file('foto')->move("images/", $fileName);

            $add->foto = $fileName;
            $add->save();
        }

        return redirect()->to('/siswa')->withStatus('Data Berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::leftJoin('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->leftJoin('tahun', 'siswa.id_tahun', '=', 'tahun.id_tahun')->findOrFail($id);

        return view('siswa.show')->with('siswa', $siswa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::leftJoin('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->leftJoin('tahun', 'siswa.id_tahun', '=', 'tahun.id_tahun')->findOrFail($id);
        $keringanan = 2700000 - $siswa->total_spp;
        $kelas = Kelas::all();
        $tahun = Tahun::all();
        return view('siswa.edit')->with('siswa', $siswa)->with('keringanan', $keringanan)->with('agama', $this->agama)->with('kelas', $kelas)->with('tahun', $tahun);
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

        $siswa = Siswa::findOrFail($id);
        $validator = Validator::make($request->all(), $this->rules, $this->pesan);
        if ($validator->fails()) {
            return redirect('siswa/tambah')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            if ($request->has('foto')) {
                $file       = $request->file('foto');
                $fileName   = $file->getClientOriginalName();
                $siswa->no_induk = $request['no_induk'];
                $siswa->nama = $request['nama'];
                $siswa->tempat_lahir = $request['tempat_lahir'];
                $siswa->tgl_lahir = $request['tgl_lahir'];
                $siswa->jenis_kelamin = $request['jenis_kelamin'];
                $siswa->agama = $request['agama'];
                $siswa->alamat = $request['alamat'];
                $siswa->id_kelas = $request['id_kelas'];
                $siswa->id_tahun = $request['id_tahun'];
                $siswa->nama_wali = $request['nama_wali'];
                $siswa->telepon = $request['telepon'];
                $siswa->total_spp = str_replace('.', '', $request['total_spp']);
                $siswa->keterangan = $request['keterangan'];
                $request->file('foto')->move("images/", $fileName);
                $siswa->foto = $fileName;
                $siswa->update();
            } else {
                $siswa->no_induk = $request['no_induk'];
                $siswa->nama = $request['nama'];
                $siswa->tempat_lahir = $request['tempat_lahir'];
                $siswa->tgl_lahir = $request['tgl_lahir'];
                $siswa->jenis_kelamin = $request['jenis_kelamin'];
                $siswa->agama = $request['agama'];
                $siswa->alamat = $request['alamat'];
                $siswa->id_kelas = $request['id_kelas'];
                $siswa->id_tahun = $request['id_tahun'];
                $siswa->nama_wali = $request['nama_wali'];
                $siswa->telepon = $request['telepon'];
                $siswa->total_spp = str_replace('.', '', $request['total_spp']);
                $siswa->keterangan = $request['keterangan'];
                $siswa->update();
            }
        }
        return redirect()->to('/siswa')->withStatus('Data Berhasil diupdate!');
    }

    public function vmutasi(){
        $kelas = Kelas::all();
        $tahun = Tahun::where('status', 'Aktif')->get();
        $siswa = Siswa::leftJoin('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->leftJoin('tahun', 'siswa.id_tahun', '=', 'tahun.id_tahun')->get();
        return view('mutasi.index')->with('kelas', $kelas)->with('tahun', $tahun)->with('siswa', $siswa);
    }

    public function mutasi(Request $request){
        $tahun = Tahun::select('id_tahun')->where('status', 'Aktif')->first();
        foreach ($request->id_siswa as $siswa) {
            $siswa = Siswa::findOrFail($siswa);
            $siswa->id_kelas = $request['id_kelas'];
            $siswa->id_tahun = $tahun->id_tahun;
            $siswa->save();
        }
        return redirect()->to('siswa/mutasi')->withStatus('Mutasi Berhasil!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();

        return redirect()->to('/siswa')->withStatus('Siswa Berhasil dihapus!');
    }
}
