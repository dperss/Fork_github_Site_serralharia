<?php

require_once dirname(__FILE__)."/DB.php";/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ccategoria
 *
 * @author Diogo Ramos
 */
class CategoriaDAL {
    public static function create($e){
        $db=DB::getDB();
        $query="INSERT INTO categoria (nome) "
            . "VALUES (:nome)";
        $parms=[
            'nome' => $e->nome,
        ];
        $res=$db->query($query,$parms);
        if($res){
            $e->id=$db->lastInsertId();
        }
        return($res);
    }

    public static function delete($e){
        $db=DB::getDB();
        $query="DELETE FROM categoria WHERE id =:id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);

        return($res);
    }

    public static function retrieveAll(){
        $db=DB::getDB();
        $query="SELECT * FROM categoria";
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function retrieveByName($e){
        $db=DB::getDB();
        $query="SELECT * FROM categoria WHERE nome=:nome";
        $parms=[
            'nome' => $e->nome
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"categoria");
        $row=$res->fetch();
        if($row){
            $e->copy($row);
        }
        return($row);
    }

    public static function retrieveById($e){
        $db=DB::getDB();
        $query="SELECT * FROM categoria WHERE id=".$e;
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_CLASS,"categoria");
        $row=$res->fetch();
        return($row);
    }

    public static function update($e){
        $db=DB::getDB();
        $query="UPDATE categoria set nome=:nome WHERE id=:id";
        $params=[
            ':nome' => $e->nome,
            ':id' => $e->id
        ];
        $res=$db->query($query, $params);

        return($res);
    }

    public static function validate($e, $create){
        $db=DB::getDB();
        if($create)
            if(categoriaDAL::retrieveByName($e))
                return ($e->id=-1);
        return 0;
    }

}
