<?php

namespace app\controllers;

use app\core\Controller;
use app\models\service\Service;
use app\core\Flash;
use app\models\service\ClienteService;

class ClienteController extends Controller
{

    public function index()
    {
        $dados["lista"]  = Service::lista("cliente");
        $dados["view"]  = "Cliente/Index";
        $this->load("template", $dados);
    }

    public function create()
    {
        $dados["cliente"] = Flash::getForm();
        $dados["view"] = "Cliente/Create";
        $this->load("template", $dados);
    }

    public function edit($id)
    {
        $cliente = Service::get("cliente", "id_cliente", $id);
        if(!$cliente) {
            $this->redirect(URL_BASE . "cliente/index");
        }
        $dados["cliente"] = $cliente;
        $dados["view"] = "Cliente/Create";
        $this->load("template", $dados);
    }

    public function salvar() {
        $cliente                  = new \stdClass(); 
        $cliente->id_cliente      = $_POST['id_cliente'];                      
        $cliente->cliente         = $_POST['cliente'];                      
        $cliente->endereco        = $_POST['endereco'];                                         
        $cliente->numero          = $_POST['numero'];                      
        $cliente->bairro          = $_POST['bairro'];                      
        $cliente->cidade          = $_POST['cidade'];                      
        $cliente->uf              = $_POST['uf'];                      
        $cliente->cep             = $_POST['cep'];                      
        $cliente->celular         = $_POST['celular'];                      
        $cliente->cpf             = $_POST['cpf'];                      
        $cliente->sexo            = $_POST['sexo'];                      
        $cliente->email           = $_POST['email'];                                          
        $cliente->data_cadastro   = date("Y-m-d");  
        
        Flash::setForm($cliente);
        if(ClienteService::salvar($cliente, "id_cliente", "cliente")) {
            $this->redirect(URL_BASE . "cliente/index");
        }else{
            $this->redirect(URL_BASE . "cliente/create");
        }
    }

    public function excluir($id) {
        ClienteService::excluir($id);
        $this->redirect(URL_BASE . "cliente/index");
    }
}
