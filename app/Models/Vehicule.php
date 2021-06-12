<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicule extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function cello() {
        return $this->belongsTo(Cello::class);
    }

    public function interventions() {
        return $this->hasMany(Intervention::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
