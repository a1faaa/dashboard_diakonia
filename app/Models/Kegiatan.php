<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    public $primaryKey = 'kegiatan_id';

    protected $fillable = [
        'kegiatan_name',
        'anggaran_id',
        'proker_id',
        'kegiatan_tanggal',
        'kegiatan_deskripsi',
        'kegiatan_lampiran',
        'kegiatan_nominal',
        'user_id',
    ];

    public function anggaran()
    {
        return $this->hasOne(Anggaran::class, 'anggaran_id', 'anggaran_id');
    }
    public function proker()
    {
        return $this->hasOne(Proker::class, 'proker_id', 'proker_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
}
