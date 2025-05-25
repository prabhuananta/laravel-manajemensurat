<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verifikator extends Model
{
    public $timestamps = true;
    protected $table = 'verifikator';
    protected $fillable = [
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
