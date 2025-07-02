<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'jenis_kelamin',
        'umur_bulan',
        'berat',
        'tinggi',
        'lingkar_kepala',
        'lingkar_lengan',
        'kecamatan',
        'jumlah_vit_a',
        'pendidikan_ayah',
        'pendidikan_ibu',
        'status_gizi',
        'tanggal_lahir',
    ];


    public function riwayats()
    {
        return $this->hasMany(Riwayat::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
