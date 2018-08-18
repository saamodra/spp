<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    protected $table = 'identitas';

    protected $primaryKey = 'id_identitas';

    protected $fillable = ['nama_instansi', 'alamat', 'kota', 'telp', 'website', 'keuangan', 'logo', 'spp_perbulan'];
}
