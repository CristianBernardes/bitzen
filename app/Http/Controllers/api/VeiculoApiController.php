<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\VeiculoRepository;


class VeiculoApiController extends Controller
{
    protected $repository;

    public function __construct(VeiculoRepository $model)
    {
        $this->repository = $model;
    }
}
