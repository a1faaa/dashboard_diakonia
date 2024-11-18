<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;
    public $primaryKey = 'anggaran_id';

    protected $fillable = [
        'anggaran_name',
        'anggaran_deskripsi',
        'anggaran_isActive',
    ];

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'anggaran_id', 'anggaran_id');
    }
    
    public function anggaranProker()
    {
        return $this->hasMany(AnggaranProker::class, 'anggaran_id', 'anggaran_id');
    }

    public function nominal()
    {
        $total = 0;

        // Fetch all related AnggaranProker records
        $anggaran_prokers = $this->anggaranProker; // Use dynamic property

        // Iterate through the collection and sum the nominal values
        foreach ($anggaran_prokers as $value) {
            $total += $value->anggaran_proker_nominal;
        }

        return $total;
    }

}
