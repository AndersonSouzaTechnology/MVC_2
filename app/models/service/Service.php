<?php

namespace app\models\service;
use app\core\Flash;

use app\models\dao\Dao;

class Service
{
    public static function lista($tabela)
    {
        $dao = new Dao();
        return $dao->lista($tabela);
    }

    public static  function get($tabela, $campo, $valor)
    {
        $dao = new Dao();
        return  $dao->get($tabela, $campo, $valor);
    }

    public static function salvar($objeto, $campo, array $erros, $tabela)
    {
        $resultado = false;
        if (!$erros) {
            $dao = new Dao();
            if ($objeto->$campo) {
                $resultado =  $dao->editar(objToArray($objeto), $campo, $tabela);
                if ($resultado) {
                    Flash::setMsg("Registro Alterado com sucesso!");
                } else {
                    Flash::setMsg("Não foi Possível alterar o registro ", -1);
                }
            } else {
                $resultado =  $dao->inserir(objToArray($objeto), $tabela);
                if ($resultado) {
                    Flash::setMsg("Registro inserido com sucesso!");
                } else {
                    Flash::setMsg("Não foi Possível Inserir os dados", -1);
                }
            }
            Flash::limpaForm();
        } else {
            Flash::limpaErro();
            Flash::setErro($erros);
        }
        return $resultado;
    }

}
