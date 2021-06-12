<?php

namespace App\Models\Mst;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'mst_siswa';
    protected $fillable = ['nama', 'nis', 'nisn', 'kelas', 'jk', 'tgl_lahir'];
}
