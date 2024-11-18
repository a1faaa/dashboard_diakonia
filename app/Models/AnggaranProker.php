<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggaranProker extends Model
{
    use HasFactory;
    public $primaryKey = 'anggaran_proker_id';

    protected $fillable = [
        'anggaran_id',
        'proker_id',
        'anggaran_proker_nominal',
    ];

    public function anggaran()
    {
        return $this->hasOne(Anggaran::class, 'anggaran_id', 'anggaran_id');
    }
    public function proker()
    {
        return $this->hasOne(Proker::class, 'proker_id', 'proker_id');
    }
}
