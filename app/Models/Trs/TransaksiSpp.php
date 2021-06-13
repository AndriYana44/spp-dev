<?php

namespace App\Models\Trs;

use App\Models\Mst\Bulan;
use App\Models\Mst\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSpp extends Model
{
    use HasFactory;
    protected $table = 'trs_transaksi_spp';
    protected $fillable = ['no_transaksi', 'bayar', 'sisa_bayar', 'tahun', 'id_siswa', 'id_bulan', 'spp', 'is_pending', 'is_paid'];

    public function bulan()
    {
        return $this->belongsTo(Bulan::class, 'id_bulan');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
