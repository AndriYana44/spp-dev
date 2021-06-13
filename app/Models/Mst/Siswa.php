<?php

namespace App\Models\Mst;

use App\Models\Trs\TransaksiInfo;
use App\Models\Trs\TransaksiSpp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'mst_siswa';
    protected $fillable = ['nama', 'nis', 'nisn', 'kelas', 'jk', 'tgl_lahir'];

    public function transaksi()
    {
        return $this->hasOne(TransaksiSpp::class, 'id');
    }

}
