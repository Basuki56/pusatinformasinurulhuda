<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumens';
    protected $primaryKey = 'id_dokumen';
    public $timestamps = true;

    protected $fillable = [
        'judul_dokumen',
        'deskripsi',
        'file_url',
        'tanggal_upload',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
