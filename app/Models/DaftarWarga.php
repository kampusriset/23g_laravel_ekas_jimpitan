<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarWarga extends Model
{
    use HasFactory;
    protected $table = 'warga';
    protected $fillable = [
        'nama',
        'no_rumah',
    ];

    
}
