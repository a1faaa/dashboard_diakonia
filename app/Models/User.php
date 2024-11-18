<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $primaryKey  = 'user_id';
    protected $fillable = [
        'username',
        'fullname',
        'role',
        'password',
    ];

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'user_id', 'user_id');
    }
}
