<?php

require_once dirname(__FILE__)."/DB.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produto
 *
 * @author Diogo Ramos
 */
class ProdutoDAL {

    public static function create($e){
        $db=DB::getDB();
        $query="INSERT INTO produto (nome,Categoria_id) "
            . "VALUES (:nome, Categoria_id)";
        $parms=[
            'nome' => $e->nome,
            'Categoria_id' => $e->Categoria_id
        ];
        $res=$db->query($query,$parms);
        if($res){
            $e->id=$db->lastInsertId();
        }
        return($res);
    }

    public static function delete($e){
        $db=DB::getDB();
        $query="DELETE FROM produto WHERE id =:id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);

        return($res);
    }

    public static function retrieveAll(){
        $db=DB::getDB();
        $query="SELECT * FROM produto";
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function retrieveByName($e){
        $db=DB::getDB();
        $query="SELECT * FROM produto WHERE nome=:nome";
        $parms=[
            'nome' => $e->nome
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"produto");
        $row=$res->fetch();
        if($row){   
            $e->copy($row);
        }
        return($row);
    }

    public static function retrieveById($e){
        $db=DB::getDB();
        $query="SELECT * FROM produto WHERE id=".$e;
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_CLASS,"produto");
        $row=$res->fetch();
        return($row);
    }

    public static function update($e){
        $db=DB::getDB();
        $query="UPDATE produto set nome=:nome, Categoria_id=:Categoria_id WHERE id=:id";
        $params=[
            ':nome' => $e->nome,
            ':Categoria_id' => $e->Categoria_id,
            ':id' => $e->id
        ];
        $res=$db->query($query, $params);

        return($res);
    }

    public static function validate($e, $create){
        $db=DB::getDB();
        if($create)
            if(produtoDAL::retrieveByName($e))
                return ($e->id=-1);
        if($e->preco<0 || $e->quant_produto<0)
            return ($e->id=-2);
        return 0;
    }

    public static function pesquisa($palavra){
        $db=DB::getDB();
        $query="SELECT id, nome, Categoria_id FROM produto WHERE nome LIKE '%".$palavra."%' ORDER BY id";
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        return $res;
    }
}
