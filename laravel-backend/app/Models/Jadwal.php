<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;
    /**
    * fillable
    *
    * @var array
    */
    protected $fillable = [
    'NIM', //Primary key
    'id_matkul', //Foreign key dari tabel KRS
    'nama_dosen',
    'ruang',
    'jam',
    ];

}
