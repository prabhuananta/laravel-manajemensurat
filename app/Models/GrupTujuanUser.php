<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupTujuanUser extends Model
{
    public $timestamps = false;
    protected $table = 'grup_tujuan_user';

    protected $fillable = [
        'grup_tujuan_id',
        'user_id',
    ];

    public function grupTujuan()
    {
        return $this->belongsTo(GrupTujuan::class, 'grup_tujuan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
