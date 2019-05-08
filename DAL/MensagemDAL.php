<?php
require_once dirname(__FILE__)."/DB.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mensagem
 *
 * @author Diogo Ramos
 */
class MensagemDAL {

    public static function create($e){
        $data = date("Y-m-d H:i:s"); 

        $db=DB::getDB();
        $query="INSERT INTO mensagem (assunto, data, utilizador_id) "."VALUES (:assunto,:data,:utilizador_id)";
        $parms=[
            'descricao' => $e->descricao,
            'data' => $data,
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
        $query="DELETE FROM mensagem WHERE id = :id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);

        return($res);
    }

    public static function retrieveAll(){
        $db=DB::getDB();
        $query="SELECT * FROM mensagem";

        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        return($res);
    }

    public static function retrieveByData($e){// acabar
        $db=DB::getDB();
        $query="SELECT * FROM mensagem WHERE data=:data ";
        $parms=[
            'data' => $e->data
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"Mensagem");
        $row=$res->fetch();
        if($row){
            $e->copy($row);
        }
        return($row);
    }

    public static function retrieveByID($e){
        $db=DB::getDB();
        $query="SELECT * FROM mensagem WHERE id=:id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"mensagem");
        $row=$res->fetch();
        if($row){
            $e->copy($row);
        }
        return($row);
    }


    public static function update($e){
        $db=DB::getDB();
        $data = date("Y-m-d H:i:s");
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
