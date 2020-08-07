<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\AbastecimentoRepository;


class AbastecimentoApiController extends Controller
{
    protected $repository;

    public function __construct(Request $request, AbastecimentoRepository $model)
    {
        $this->repository = $model;
    }
}
