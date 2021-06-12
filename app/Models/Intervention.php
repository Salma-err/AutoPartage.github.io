<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervention extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function vehicule() {
        return $this->belongsTo(Vehicule::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
