<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $primaryKey = 'id_siswa';

    protected $fillable = ['id_siswa', 'no_induk', 'nama', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'agama', 'alamat', 'id_kelas', 'id_tahun', 'nama_wali', 'telepon', 'total_spp', 'status', 'keterangan', 'foto'];
}
