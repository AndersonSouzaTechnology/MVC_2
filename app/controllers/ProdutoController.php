<?php

namespace app\controllers;

use app\core\Controller;
use app\models\service\Service;
use app\core\Flash;
use app\models\service\ProdutoService;

class ProdutoController extends Controller
{
    private $tabela = "produto";
    private $campo = "id_produto";

    public function index()
    {
        $dados["lista"]  = Service::lista($this->tabela);
        i($dados["lista"]);
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
        $cliente = Service::get($this->tabela, $this->campo, $id);
        if(!$cliente) {
            $this->redirect(URL_BASE . "cliente/index");
        }
        $dados["produto"] = $produto;
        $dados["view"] = "Cliente/Create";
        $this->load("template", $dados);
    }

    public function salvar() {
        $produto                  = new \stdClass(); 
        $produto->id_produto      = null;                      
        $produto->produto         = "teste";                      
        $produto->preco           = 100;

        Flash::setForm($produto);
        if(Service::salvar($produto, $this->campo, array(), $this->tabela)) {
            $this->redirect(URL_BASE . "produto/index");
        }else{
            $this->redirect(URL_BASE . "produto/create");
        }
    }

    public function excluir($id) {
        Service::excluir($this->tabela, $this->campo, $id);
        $this->redirect(URL_BASE . "produto/index");
    }
}
