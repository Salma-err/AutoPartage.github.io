<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cello extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function cello_type() {
        return $this->belongsTo(Cello_type::class);
    }

    public function carte() {
        return $this->belongsTo(Carte::class);
    }

    public function vehicule() {
        return $this->hasOne(Vehicule::class);
    }
}
