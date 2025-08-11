<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\DaftarWarga;
use App\Models\Petugas;

class AmbilJimpit extends Model
{
    use HasFactory;

    protected $table = 'ambil_jimpit'; // biar gak dianggap 'ambil_jimpits'

    protected $primaryKey = 'id_ambil';

    public $timestamps = false; // karena cuma ada created_at, gak ada updated_at

    protected $fillable = [
        'petugas_id',
        'warga_id',
        'tanggal_ambil',
        'nominal',
    ];

    protected $casts = [
        'tanggal_ambil' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function warga()
    {
        return $this->belongsTo(DaftarWarga::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id', 'id_petugas');
    }

    public function getFormattedNominalAttribute()
    {
        return number_format($this->nominal, 0, ',', '.');
    }
}
