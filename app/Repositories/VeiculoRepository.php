<?php

namespace App\Repositories;

use App\Models\Veiculo;

class VeiculoRepository extends AbstractRepository
{
    protected $model = Veiculo::class;
    protected $upload = ['name' => 'image', 'path' => 'veiculos'];
}
