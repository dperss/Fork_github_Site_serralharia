<?php
require_once dirname(__FILE__)."/DB.php";
require_once dirname(__FILE__).'/../DAL/FuncionarioDAL.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of produtos_reservados
 *
 * @author Diogo Ramos
 */
class PropostaDAL {
    public static function create($e){
        $idFuncionario= FuncionarioDAL::retriveId(); //guarda o id do funcionário na variável
        $data = date("Y-m-d H:i:s"); //devolve a data atual do sistema, no formato ano-mes-dia horas:minutos:segundos, exemplo: 2017-05-25 22:57:00
        $db=DB::getDB();
        $query="INSERT INTO proposta (descricao, data, orcamento, funcionario_id, pedido_id) "."VALUES (:descricao, :data ,:orcamento, :funcionario_id, :pedido_id)";
        $parms=[
            'descricao' => $e->descricao,
            'data' => $data,
            'orcamento' => $e->orcamento,
            'funcionario_id' => $idFuncionario,
            'pedido_id' => $e->pedido_id,
        ];
        $res=$db->query($query,$parms);
        if($res){
            $e->id=$db->lastInsertId();
        }
        return($res);
    }

    public static function delete($e){
        $db=DB::getDB();
        $query="DELETE FROM proposta WHERE id = :id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);

        return($res);
    }

    public static function retrieveAll(){
        $db=DB::getDB();
        $query="SELECT * FROM proposta";

        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        return($res);
    }

    public static function retrieveByID($e){
        $db=DB::getDB();
        $query="SELECT * FROM proposta WHERE id=:id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"proposta"); //Para podermos usar a notacao de objeto em vez de array
        $row=$res->fetch(); //Como o name é unico so pode dar 1 valor ou 0 logo podemos fazer o fetch de um so valor em vez de um while
        if($row){   //Com isto inserimos os atributos da BD na instancia criada no index que entra neste metodo
            $e->copy($row);
        }
        return($row);
    }

    public static function retrieveByName(){
        $db=DB::getDB();
        $query="SELECT descricao FROM proposta";

        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_CLASS,"proposta"); //Para podermos usar a notacao de objeto em vez de array
        return($res);
    }

    public static function retrieveIdName(){
        $db=DB::getDB();
        $query="SELECT id, descricao FROM proposta";
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC); //Devolve um array associativo entre id e descrição
        return $res;
    }

    public static function retrieveOrcamento(){ //Devolve o valor do orçamento da proposta
        $db=DB::getDB();
        $query='SELECT orcamento FROM proposta';
        $res=$db->query($query);
        $orcamento=$res->fetchColumn();
        return($orcamento);
    }

    public static function update($e){
        $idFuncionario= FuncionarioDAL::retriveId(); //guarda o id do funcionário na variável
        $data = date("Y-m-d H:i:s"); //devolve a data atual do sistema, no formato ano-mes-dia horas:minutos:segundos, exemplo: 2017-05-25 22:57:00
        $db=DB::getDB();
        $query="UPDATE proposta set descricao=:descricao, data=:data, orcamento=:orcamento, funcionario_id=:funcionario_id WHERE id=:id";
        $params=[
            ':descricao' => $e->descricao,
            ':data' => $data,
            ':orcamento' => $e->orcamento,
            ':funcionario_id' => $idFuncionario,
            ':id' => $e->id
        ];
        $res=$db->query($query, $params);

        return($res);
    }

    public static function validate($e){
        $db=DB::getDB();
        if($e->orcamento < 0)
            return ($e->id=-1);
        else return 0;
    }

    public static function nPropostas($e){
        $db=DB::getDB();
        $query="SELECT count(*) FROM proposta";
        $res=$db->query($query);
        $nProposta=$res->fetchColumn();
        return($nProposta);
    }
}
