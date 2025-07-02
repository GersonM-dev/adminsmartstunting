<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $fillable = [
        'anak_id',
        'timestamp',
        'status_stunting',
        'status_underweight',
        'status_wasting',
        'rekomendasi',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
}
