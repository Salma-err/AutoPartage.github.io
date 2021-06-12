<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carte extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function cello() {
        return $this->hasOne(Cello::class);
    }
}
