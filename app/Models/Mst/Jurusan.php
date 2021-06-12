<?php

namespace App\Models\Mst;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'mst_jurusan';
    protected $fillable = ['id_jurusan', 'jurusan'];
}
