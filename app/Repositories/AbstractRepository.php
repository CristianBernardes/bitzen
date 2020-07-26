<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

abstract class AbstractRepository
{
    use ValidatesRequests;

    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    /**
     * Obtem todos os dados da tabela 
     * @param object $model representa qual Model deve ser chamada quando ele consultar algo no banco.
     * @return [json] $data retorna todos os objetos da tabela consutada.
     */

    public function all()
    {
        return $this->model->all();
    }

    /**
     * Cria um dado na tabela
     * @param object $request é o que o usuário envia como parametros para ser inseridos na tabela.
     * @param object $this->upload representa se há ou não upload de arquivos.
     * @return [json] $data retorna o dado que acabou de ser inserido na tabela que a Model Representa.
     */

    public function store(Request $request)
    {
        $this->validate($request, $this->model->rules());

        $dataForm = $request->all();

        if ($this->upload && $request->hasFile($this->upload['name'])) {

            $folder = $this->upload['path'];

            $image = $request->file($this->upload['name']);

            $nameFile = uniqid(date('YmdHis')) . '.' . $image->getClientOriginalExtension();

            list($width, $height) = getimagesize($image);

            if ($width <= 450) {
                $upload = Image::make($image)->resize($width, $height)->save(public_path('assets/img/' . $folder . '/' . $nameFile, 100));
            } else {
                $upload = Image::make($image)->resize($width / 4, $height / 4)->save(public_path('assets/img/' . $folder . '/' . $nameFile, 100));
            }
            if (!$upload) {
                return response()->json(['error' => 'Falha ao fazer upload'], 500);
            } else {
                $dataForm[$this->upload['name']] = $nameFile;
            }
        }

        $data = $this->model->create($dataForm);

        return response()->json($data, 200);
    }

    /**
     * Obtém dado por ID
     * @param object $model representa qual Model deve ser chamada quando ele consultar algo no banco
     * @param int $id representa qual id o usuário está buscado no banco
     * @return [json] $data retorna o objeto consultado da tabela.
     */

    public function show($id)
    {
        if (!$data = $this->model->find($id)) {
            return response()->json(['error' => 'Nenhum dado encontrado'], 404);
        } else {
            return response()->json($data, 200);
        }
    }

    /**
     * Cria um dado na tabela
     * @param int $id representa qual id o usuário está buscado no banco.
     * @param object $request é o que o usuário envia como parametros para ser inseridos na tabela.
     * @param object $this->upload representa se há ou não upload de arquivos.
     * @return [json] $data retorna o dado que acabou de ser inserido na tabela que a Model Representa.
     */

    public function update(Request $request, $id)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return response()->json(['error' => 'Nada foi encontrado!'], 404);
        }

        $this->validate($request, $this->model->rules());

        $dataForm = $request->all();

        if ($request->hasFile($this->upload['name']) && $request->file($this->upload['name'])->isValid()) {

            if ($data->image) {
                Storage::disk('local')->delete("/{$this->upload['path']}/$data->image");
            }

            $folder = $this->upload['path'];

            $image = $request->file($this->upload['name']);

            $nameFile = uniqid(date('YmdHis')) . '.' . $image->getClientOriginalExtension();

            list($width, $height) = getimagesize($image);

            if ($width <= 450) {
                $upload = Image::make($image)->resize($width, $height)->save(public_path('assets/img/' . $folder . '/' . $nameFile, 100));
            } else {
                $upload = Image::make($image)->resize($width / 4, $height / 4)->save(public_path('assets/img/' . $folder . '/' . $nameFile, 100));
            }
            if (!$upload) {
                return response()->json(['error' => 'Falha ao fazer upload'], 500);
            } else {
                $dataForm[$this->upload['name']] = $nameFile;
            }
        }

        $data->update($dataForm);

        return response()->json($data);
    }

    /**
     * Deleta um dado da tabela pelo ID.
     * @param object $model representa qual Model deve ser chamada quando ele consultar algo no banco.
     * @param int $id representa qual id o será buscado no banco antes de deletar.
     * @param string $nameFile verifica se a model tem algum arquivo a ser deletado.
     * @return [json] com mensagem de sucesso ou error
     */

    public function destroy($id)
    {
        if ($data = $this->model->find($id)) {

            if ($this->upload) {
                Storage::disk('local')->delete("/{$this->upload['path']}/$data->image");
            }
            $data->delete();
            return response()->json(['success' => 'Dado deletado com sucesso!']);
        } else {
            return response()->json(['error' => 'Nenhum dado encontrado!'], 404);
        }
    }

    /**
     * Resolve model
     * @return [string] model object
     */

    protected function resolveModel()
    {
        return app($this->model);
    }
}
