<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function planos()
    {
        return $this->belongsToMany(Plano::class, 'cliente_plano', 'cliente_id', 'plano_id');
    }
}
