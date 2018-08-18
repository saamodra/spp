<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = 'kas';

    protected $primaryKey = 'id_kas';

    protected $fillable = ['tanggal', 'pemasukan', 'pengeluaran', 'keterangan', 'operator'];
}
