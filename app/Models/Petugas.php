<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PlotJimpit;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $fillable = ['nama_lengkap', 'is_active', 'last_activity'];
    public $timestamps = false;
   

    public function plotJimpit()
    {
        return $this->hasMany(PlotJimpit::class, 'petugas_id', 'id_petugas');
    }

    

}


