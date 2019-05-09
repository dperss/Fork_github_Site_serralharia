<?php
require_once dirname(__FILE__)."/DB.php";
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
class Produtos_ReservadosDAL {

    public static function create($e){
        $db=DB::getDB();
        $query="INSERT INTO Produtos_Reservados (preço, medidas, quantidade, produto_id, reserva_id) "."VALUES (:preço ,:medidas, :quantidade, :produto_id, :reserva_id)";
        $parms=[
            'preço' => $e->preço,
            'medidas' => $e->medidas,
            'quantidade' => $e->quantidade,
            'produto_id' => $e->produto_id,
            'reserva_id' => $e->reserva_id,
        ];
        $res=$db->query($query,$parms);
        return($res);
    }

    public static function delete($e){
        $db=DB::getDB();
        $query="DELETE FROM Produtos_Reservados WHERE id = :id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);

        return($res);
    }

    public static function findAll(){
        $db=DB::getDB();
        $query="SELECT * FROM Produtos_Reservados";
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->closeCursor();
        return($row);
    }

    public static function findByID($e){
        $db=DB::getDB();
        $query="SELECT * FROM Produtos_Reservados WHERE produto_id=:produto_id AND reserva_id=:reserva_id";
        $parms=[
            'produto_id' => $e->produto_id,
            'reserva_id' => $e->reserva_id
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"Produtos_Reservados");
        $row=$res->fetch();
        if($row){
            $e->copy($row);
        }
        $res->closeCursor();
        return($row);
    }

    public static function update($e){
        $db=DB::getDB();
        $query="UPDATE Produtos_Reservados set preço=:preço, medidas=:medidas, quantidade=:quantidade WHERE produto_id=:produto_id AND reserva_id=:reserva_id";
        $params=[
            ':preço' => $e->preço,
            ':medidas' => $e->medidas,
            ':quantidade' => $e->quantidade,
            ':produto_id' => $e->produto_id,
            ':reserva_id' => $e->reserva_id
        ];
        $res=$db->query($query, $params);

        return($res);
    }

    public static function validate($e){
        $db=DB::getDB();
        if($e->quantidade <= 0)
            return ($e->id=-1);
        else return 0;
    }

}
