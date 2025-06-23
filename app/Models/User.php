<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $timestamps = true;

    protected $fillable = ['nama', 'email', 'password', 'role', 'unit_id'];

    protected $hidden = ['password', 'remember_token'];

    public function dokumens()
    {
        return $this->hasMany(Dokumen::class, 'id_user', 'id_user');
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'id_user', 'id_user');
    }

    // JWTSubject implementation
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
