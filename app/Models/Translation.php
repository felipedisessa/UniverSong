<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    public function song()
    {
        return $this->belongsTo(Song::class);
    }

}
