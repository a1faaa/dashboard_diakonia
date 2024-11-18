<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proker extends Model
{
    use HasFactory;
    public $primaryKey = 'proker_id';

    protected $fillable = [
        'proker_name',
        'proker_tujuan',
        'proker_sasaran',
        'proker_deskripsi',
        'proker_isActive',
    ];

    public function kegiatans(){
        return $this->hasMany(Kegiatan::class, 'proker_id', 'proker_id');
    }

    public function anggaranProker()
    {
        return $this->hasMany(AnggaranProker::class, 'proker_id', 'proker_id');
    }
}
