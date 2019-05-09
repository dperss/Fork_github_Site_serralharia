<?php
require_once dirname(__FILE__)."/DB.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reserva
 *
 * @author Diogo Ramos
 */
class ReservaDAL {

    public static function create($e){

        $data = date("Y-m-d H:i:s");
        $db=DB::getDB();
        $query="INSERT INTO reserva (data, mensagem_id) "."VALUES (:data ,:mensagem_id)";
        $parms=[
            'data' => $data,
            'mensagem_id' => $e->mensagem_id,
        ];
        $res=$db->query($query,$parms);
        if($res){
            $e->id=$db->lastInsertId();
        }
        return($res);
    }

    public static function delete($e){
        $db=DB::getDB();
        $query="DELETE FROM reserva WHERE id = :id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);

        return($res);
    }

    public static function findAll(){
        $db=DB::getDB();
        $query="SELECT * FROM reserva";

        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        return($res);
    }

    public static function findByID($e){
        $db=DB::getDB();
        $query="SELECT * FROM reserva WHERE id=:id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"reserva");
        $row=$res->fetch();
        if($row){
            $e->copy($row);
        }
        return($row);
    }

    public static function update($e){
        $data = date("Y-m-d H:i:s");
        $db=DB::getDB();
        $query="UPDATE reserva set descricao=:descricao, data=:data, orcamento=:orcamento WHERE id=:id";
        $params=[
            ':data' => $data,
            ':orcamento' => $e->orcamento,
            ':id' => $e->id
        ];
        $res=$db->query($query, $params);

        return($res);
    }

    public static function validate($e){
        $db=DB::getDB();
        return 0;
    }

    public static function nReservas($e){
        $db=DB::getDB();
        $query="SELECT count(*) FROM reserva";
        $res=$db->query($query);
        $nreserva=$res->fetchColumn();
        return($nreserva);
    }
}
