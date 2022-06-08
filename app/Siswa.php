<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $connection = 'pgsql_external';
    protected $table = 'siswas';
    protected $primaryKey = 'id';
    protected $fillable = ['nis','nama','kelas'];
}
