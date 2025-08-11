<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Petugas;

class RekapJimpitHarian extends Model
{
    protected $table = 'rekap_jimpit_harian';
    protected $primaryKey = 'id_rekap';
    public $timestamps = false; // karena hanya pakai created_at

    protected $fillable = [
        'petugas_id',
        'tanggal_rekap',
        'nominal',
        'created_at',
    ];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id', 'id_petugas');
    }
}

