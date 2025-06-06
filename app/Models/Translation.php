<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable = ['translated_lyrics'];

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
