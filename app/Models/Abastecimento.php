<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abastecimento extends Model
{
    protected $fillable = [
        'user_id',
        'veiculo_id',
        'km_abastecimento',
        'litros_abastecido',
        'valor_pago',
        'data_abastecimento',
        'posto_abastecido',
        'tipo_combustivel',

    ];

    public function rules()
    {
        return [
            'user_id' => 'required',
            'veiculo_id' => 'required',
            'km_abastecimento' => 'required',
            'litros_abastecido' => 'required',
            'valor_pago' => 'required',
            'data_abastecimento' => 'required',
            'posto_abastecido' => 'required',
            'tipo_combustivel' => 'required',
        ];
    }
}
