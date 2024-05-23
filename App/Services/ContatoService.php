<?php

namespace App\Services;

use App\Models\Contato;

class ContatoService
{
    public function get($api = null, $service = null, $param = null)
    {
        if ($param) {
            if ($param == 'last') {
                return Contato::lastid();
            } else {
                return Contato::getContato($param);
            }
        } else {
            return Contato::GetAll();
        }
    }

    public function post()
    {
        $data = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'telefone' => $_POST['telefone'],
            'ativo' => true
        ];

        return Contato::insert($data);
    }

    public function put()
    {

        $putdata = fopen("php://input", "r");
        $datastr = '';
        while ($data = fread($putdata, 1024)) {
            $datastr .= $data;
        }

        fclose($putdata);
        $dataArr = json_decode($datastr);

        $data = [
            'id' => $dataArr->id,
            'nome' => $dataArr->nome,
            'email' => $dataArr->email,
            'telefone' => $dataArr->telefone,
            'ativo' => true
        ];
        return Contato::update($data);
    }

    public function delete($api = null, $service = null, $param = null)
    {
        $id =  $param;

        return Contato::delete($id);
    }
}
