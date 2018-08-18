<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use Schema;
use File;
use Artisan;

class DatabaseController extends Controller
{
    protected $database = 'laravel_spp';

    function EXPORT_TABLES(){ 
      $host = 'localhost';
      $user = 'root';
      $pass = '';
      $drive = 'C:/xampp/htdocs/laravel_spp/storage/backup';
      $conn=mysqli_connect($host,$user,$pass);
      if (mysqli_connect_errno()) {
        echo "Koneksi Gagal : " . mysqli_connect_error();
      }
      $null = null; $hitung = time();
        if (isset($this->database)) {
          exec("c:/xampp/mysql/bin/mysqldump  -u $user --password=$pass $this->database -c>{$drive}/$this->database"."_(".date("H-i-s")."_".date("d-m-Y").").sql 2>&1", $null, $hasil);
        }
    }
    public function download($filename)
    {
        $file_path = storage_path() .'/backup/'. $filename;
        if (file_exists($file_path))
        {
            return Response::download($file_path, $filename, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            exit('Requested file does not exist on our server!');
        }
    }

    public function index(){
      return view('backup.index');
    }
    public function backup(){
      $this->EXPORT_TABLES();
      $file = 'laravel_spp_('.date('H-i-s').'_'.date('d-m-Y').').sql';
      return back()->withStatus('Backup Database Berhasil!')->withFile($file);
    }

    function IMPORT_TABLES($sql_file_OR_content){
      $restore_file  = $sql_file_OR_content;
      $server_name   = "localhost";
      $username      = "root";
      $password      = "";
      $database_name = "laravel_spp";

      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      foreach(\DB::select('SHOW TABLES') as $table) {
          $table_array = get_object_vars($table);
          \Schema::drop($table_array[key($table_array)]);
      }

      $cmd = "c:/xampp/mysql/bin/mysql -h $server_name -u $username $database_name < $restore_file";
      exec($cmd);
    }

    public function restore(Request $request){
      $sql_file_OR_content = $request->file('sql');
      $file_path = $sql_file_OR_content->getPathName();
      $fileName = $sql_file_OR_content->getClientOriginalName();
      $tmp = explode('.', $fileName);
      $valid_ext = array('sql');
      $ext = strtolower(end($tmp));
      if(in_array($ext, $valid_ext)){
        $this->IMPORT_TABLES($file_path);
        return back()->withStatus2('Restore database berhasil!')->withInput();
      }else{
        return back()->withError2('File harus berekstensi sql!')->withInput();
      }
    }
}
