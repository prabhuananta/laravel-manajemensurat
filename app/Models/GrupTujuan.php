<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupTujuan extends Model
{
    public $timestamps = true;
    protected $table = 'grup_tujuan';

    protected $fillable = [
        'nama_grup',
        'keterangan',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'grup_tujuan_user', 'grup_tujuan_id', 'user_id');
    }
    public function grupTujuanUser()
    {
        return $this->hasMany(GrupTujuanUser::class, 'grup_tujuan_id');
    }
}
