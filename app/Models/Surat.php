<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    protected $fillable = [
        'judul_surat',
        'nomor_surat',
        'isi',
        'keterangan',
        'verifikasi',
        'status',
        'pengirim_id',
        'tujuan_id'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function tujuan()
    {
        return $this->belongsTo(User::class, 'tujuan_id');
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul_surat', 'like', '%' . $search . '%')
                ->orWhere('nomor_surat', 'like', '%' . $search . '%');
        });
    }
}
