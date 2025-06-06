<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'original_lyrics',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function translation()
    {
        return $this->hasOne(Translation::class);
    }
}
