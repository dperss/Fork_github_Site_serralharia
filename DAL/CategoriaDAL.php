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
        $query="INSERT INTO artigo (nome) "
            . "VALUES (:nome)";
        $parms=[
            'nome' => $e->nome,
            //'proposta_id' => $e->proposta_id
        ];
        $res=$db->query($query,$parms);
        if($res){
            $e->id=$db->lastInsertId();
        }
        return($res);
    }

    public static function delete($e){
        $db=DB::getDB();
        $query="DELETE FROM artigo WHERE id =:id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);

        return($res);
    }

    public static function retrieveAll(){
        $db=DB::getDB();
        $query="SELECT * FROM artigo";
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function retrieveByName($e){
        $db=DB::getDB();
        $query="SELECT * FROM artigo WHERE nome=:nome";
        $parms=[
            'nome' => $e->nome
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"artigo"); //Para podermos usar a notacao de objeto em vez de array
        $row=$res->fetch(); //Como o name é unico so pode dar 1 valor ou 0 logo podemos fazer o fetch de um so valor em vez de um while
        if($row){   //Com isto inserimos os atributos da BD na instancia criada no index que entra neste metodo
            $e->copy($row);
        }
        return($row);
    }

    public static function retrieveById($e){
        $db=DB::getDB();
        $query="SELECT * FROM artigo WHERE id=".$e;
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_CLASS,"artigo");
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
        $db=DB::getDB();                      //faz a conexão à BD
        if($create)                           //se for para criar registos na BD
            if(ArtigoDAL::retrieveByName($e)) //verifica-se se o nome já existe e caso seja verdade
                return ($e->id=-1);           //não deixa registar nomes repetidos
        return 0;                             //senão retorna 0, simbolizando sucesso
    }

    public static function pesquisa($palavra){
        $db=DB::getDB();
        $query="SELECT id, nome, preco, quant_artigo, descricao FROM artigo WHERE nome LIKE '%".$palavra."%' ORDER BY id";
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        return $res;
    }
}
