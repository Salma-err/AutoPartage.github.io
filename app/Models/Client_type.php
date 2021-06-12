<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client_type extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function client() {
        return $this->hasOne(Client::class);
    }
}
