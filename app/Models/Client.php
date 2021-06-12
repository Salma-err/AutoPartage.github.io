<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function client_type() {
        return $this->belongTo(Client_type::class);
    }

    public function vehicules() {
        return $this->hasMany(Vehicule::class);
    }
}
