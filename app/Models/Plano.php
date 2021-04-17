<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;
    protected $fillable = ['nome','valor'];

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_plano', 'cliente_id', 'plano_id');
    }
}
