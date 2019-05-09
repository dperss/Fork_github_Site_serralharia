<?php

require_once dirname(__FILE__)."/DB.php";/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 * @author Diogo Ramos
 */
class CategoriaDAL {
    public static function create($e){
        $db=DB::getDB();
        $query="INSERT INTO Categoria (nome) " . "VALUES (:nome)";
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
        $query="DELETE FROM Categoria WHERE id =:id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);

        return($res);
    }

    public static function findAll(){
        $db=DB::getDB();
        $query="SELECT * FROM Categoria";
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function findByName($e){
        $db=DB::getDB();
        $query="SELECT * FROM Categoria WHERE nome=:nome";
        $parms=[
            'nome' => $e->nome
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"Categoria");
        $row=$res->fetch();
        if($row){
            $e->copy($row);
        }
        $res->closeCursor();
        return($row);
    }

    public static function findById($e){
        $db=DB::getDB();
        $query="SELECT * FROM Categoria WHERE id=".$e;
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_CLASS,"Categoria");
        $row=$res->fetch();
        $res->closeCursor();
        return($row);
    }

    public static function update($e){
        $db=DB::getDB();
        $query="UPDATE Categoria set nome=:nome WHERE id=:id";
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
            if(CategoriaDAL::findByName($e))
                return ($e->id=-1);
        return 0;
    }

}
