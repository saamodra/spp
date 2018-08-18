<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = ['id_siswa', 'id_kelas', 'id_tahun', 'bayar', 'tgl_bayar', 'keterangan', 'operator'];
}
