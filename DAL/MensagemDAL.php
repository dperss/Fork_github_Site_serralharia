<?php
require_once dirname(__FILE__)."/DB.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mensagem
 *
 * @author Diogo Ramos
 */
class MensagemDAL {

    public static function create($e){
        $data = date("Y-m-d H:i:s"); 

        $db=DB::getDB();
        $query="INSERT INTO Mensagem (assunto, data, utilizador_id, mensagem) "."VALUES (:assunto,:data,:utilizador_id, mensagem)";
        $parms=[
            'assunto' => $e->assunto,
            'data' => $data,
            'utilizador_id' => $e->utilizador_id,
            'mensagem' => $e->mensagem
        ];
        $res=$db->query($query,$parms);
        if($res){
            $e->id=$db->lastInsertId();
        }
        return($res);
    }

    public static function delete($e){
        $db=DB::getDB();
        $query="DELETE FROM Mensagem WHERE id = :id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);

        return($res);
    }

    public static function findAll(){
        $db=DB::getDB();
        $query="SELECT * FROM Mensagem";

        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        return($res);
    }

    public static function findByData($e){// acabar
        $db=DB::getDB();
        $query="SELECT * FROM Mensagem WHERE data=:data ";
        $parms=[
            'data' => $e->data
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"Mensagem");
        $row=$res->fetch();
        if($row){
            $e->copy($row);
        }
        $res->closeCursor();
        return($row);
    }

    public static function findByID($e){
        $db=DB::getDB();
        $query="SELECT * FROM Mensagem WHERE id=:id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"Mensagem");
        $row=$res->fetch();
        if($row){
            $e->copy($row);
        }
        $res->closeCursor();
        return($row);
    }


    public static function update($e){
        $db=DB::getDB();
        $data = date("Y-m-d H:i:s");
        $query="UPDATE Mensagem set data=:data, assunto=:assunto WHERE id=:id";
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
