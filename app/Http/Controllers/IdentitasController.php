<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Identitas;

class IdentitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $identitas = Identitas::first();
        
        return view('identitas.index')->with('identitas', $identitas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $update = Identitas::findOrFail(1);
        if ($request->has('logo')) {
          $file       = $request->file('logo');
          $fileName   = $file->getClientOriginalName();
          $update->nama_instansi = $request['nama_instansi'];
          $update->alamat = $request['alamat'];
          $update->kota = $request['kota'];
          $update->telp = $request['telp'];
          $update->website = $request['website'];
          $update->keuangan = $request['keuangan'];
          $request->file('logo')->move("images/", $fileName);
          $update->logo = $fileName;
          $update->update();
        }else{
          $update->nama_instansi = $request['nama_instansi'];
          $update->alamat = $request['alamat'];
          $update->kota = $request['kota'];
          $update->telp = $request['telp'];
          $update->website = $request['website'];
          $update->keuangan = $request['keuangan'];
          $update->update();
        }

        return redirect()->to('identitas')->withStatus('Identitas berhasil diupdate!');
    }

    public function getSet(){
      $spp = Identitas::select('spp_perbulan')->where('id_identitas', 1)->first();

      return Response::json($spp);
    }

    public function setUpdate(Request $request){
      $update = Identitas::findOrFail(1);
      $update->spp_perbulan = str_replace('.', '', $request->spp);
      $update->update();
      return response()->json($update);
    }
}
