<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['nome','email','data_nascimento','telefone','estado','cidade'];


    public function planos()
    {
        return $this->belongsToMany(Plano::class, 'cliente_plano', 'cliente_id', 'plano_id');
    }
}
