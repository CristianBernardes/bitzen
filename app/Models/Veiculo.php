<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $fillable = [
        'user_id',
        'marca',
        'modelo',
        'ano',
        'placa',
        'tipo_veiculo',
        'tipo_combustivel',
        'quilometragem',
        'image',
    ];

    public function rules()
    {
        return [
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required',
            'placa' => 'required',
            'tipo_veiculo' => 'required',
            'tipo_combustivel' => 'required',
            'quilometragem' => 'required',
        ];
    }
}
