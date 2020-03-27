<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'sexo' => ($this->sexo === 'M') ? 'Masculino' : 'Feminino',
            'nascimento' => $this->nascimento,
            'criador' => new CriadorResource($this->criador),
            'especie' => new EspecieResource($this->especie)
        ];
    }
}
