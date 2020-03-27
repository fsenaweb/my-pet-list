<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{

    protected $fillable = [ 'nome', 'sexo', 'nascimento', 'criador_id', 'especie_id' ];

    public function criador()
    {
        return $this->belongsTo(Criador::class);
    }

    public function especie()
    {
        return $this->belongsTo(Especie::class);
    }
}
