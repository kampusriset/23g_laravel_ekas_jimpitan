<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlotJimpit extends Model
{
    protected $table = 'plot_jimpit';

    protected $primaryKey = 'id_plot';

    protected $fillable = [
        'petugas_id', 'nama_hari', 'is_active', 'is_leader',
    ];


    protected static function booted()
    {
        static::saving(function ($model) {
            $hariIni = \Carbon\Carbon::now()->locale('id')->isoFormat('dddd');

            $model->is_active = strtolower($model->nama_hari) === strtolower($hariIni);
        });
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id', 'id_petugas');
    }
}

