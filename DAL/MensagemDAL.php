<?php
require_once dirname(__FILE__)."/DB.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pedido
 *
 * @author Diogo Ramos
 */
class MensagemDAL {

    public static function create($e){
        $datapedido = date("Y-m-d H:i:s"); //devolve a data atual do sistema, no formato ano-mes-dia horas:minutos:segundos, exemplo: 2017-05-25 22:57:00

        $db=DB::getDB();
        $query="INSERT INTO pedido (descricao, datapedido, utilizador_id) "."VALUES (:descricao, :datapedido, :utilizador_id)";
        $parms=[
            'descricao' => $e->descricao,
            'datapedido' => $datapedido,
            'utilizador_id' => $e->utilizador_id
        ];
        $res=$db->query($query,$parms);
        if($res){
            $e->id=$db->lastInsertId();
        }
        return($res);
    }

    public static function delete($e){
        $db=DB::getDB();
        $query="DELETE FROM pedido WHERE id = :id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);

        return($res);
    }

    public static function retrieveAll(){
        $db=DB::getDB();
        $query="SELECT * FROM pedido";

        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC); //Para podermos usar a notacao de objeto em vez de array
        return($res);
    }

    public static function retrieveByData($e){// acabar
        $db=DB::getDB();
        $query="SELECT * FROM Mensagem WHERE data=:data ";
        $parms=[
            'data' => $e->data
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"Mensagem"); //Para podermos usar a notacao de objeto em vez de array
        $row=$res->fetch(); //Como o name é unico so pode dar 1 valor ou 0 logo podemos fazer o fetch de um so valor em vez de um while
        if($row){   //Com isto inserimos os atributos da BD na instancia criada no index que entra neste metodo
            $e->copy($row);
        }
        return($row);
    }

    public static function retrieveByID($e){
        $db=DB::getDB();
        $query="SELECT * FROM Mensagem WHERE id=:id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"mensagem"); //Para podermos usar a notacao de objeto em vez de array
        $row=$res->fetch(); //Como o name é unico so pode dar 1 valor ou 0 logo podemos fazer o fetch de um so valor em vez de um while
        if($row){   //Com isto inserimos os atributos da BD na instancia criada no index que entra neste metodo
            $e->copy($row);
        }
        return($row);
    }


    public static function update($e){
        $db=DB::getDB();
        $datapedido = date("Y-m-d H:i:s");
        $query="UPDATE mensagem set data=:data, assunto=:assunto WHERE id=:id";
        $params=[
            ':data' => $data,
            ':assunto' => $e->assunto,
            ':id' => $e->id
        ];
        $res=$db->query($query, $params);

        return($res);
    }

    public static function validate($e){
        $db=DB::getDB();
        return 0;
    }

}
