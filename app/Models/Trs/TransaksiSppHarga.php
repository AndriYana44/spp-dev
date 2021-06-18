<?php

namespace App\Models\Trs;

use App\Models\Mst\Bulan;
use App\Models\TahunPeriode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSppHarga extends Model
{
    use HasFactory;
    protected $table = 'trs_transaksi_spp_harga';

    public function tahun()
    {
        return $this->belongsTo(TahunPeriode::class, 'id_tahun');
    }

    public function bulan()
    {
        return $this->belongsTo(Bulan::class, 'id_bulan');
    }
}
