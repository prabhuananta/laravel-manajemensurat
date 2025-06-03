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
        'tujuan_id',
        'verifikator_id',
        'penandatangan_id',
        'gruptujuan_id',
        'sifat_surat',
        'jenis_surat',
        'tanggal_surat',
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
    public function penandatangan()
    {
        return $this->belongsTo(Penandatangan::class, 'penandatangan_id');
    }
    public function verifikator()
    {
        return $this->belongsTo(Verifikator::class, 'verifikator_id');
    }
    public function grupTujuan()
    {
        return $this->belongsTo(GrupTujuan::class, 'gruptujuan_id');
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul_surat', 'like', '%' . $search . '%')
                ->orWhere('nomor_surat', 'like', '%' . $search . '%');
        });
    }
}
