<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penandatangan extends Model
{
    public $timestamps = true;
    protected $table = 'penandatangan';

    protected $fillable = [
        'user_id',
        'nip',
        'file_tanda_tangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
