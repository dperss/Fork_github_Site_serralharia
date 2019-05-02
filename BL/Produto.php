<?php
require_once dirname(__FILE__).'/../DAL/ProdutoDAL.php';
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
class Produto {
    //put your code here
    public $id;
    public $nome;
    public $Categoria_id;


    public function _construct(){
        $this->Categoria_id=new Categoria();
    }
    public function copy($row){
        $this->id=$row->id;
        $this->nome=$row->nome;
        $this->Categoria_id=$row->Categoria_id;
    }

    public function create(){
        $res=false;
        $res=ProdutoDAL::create($this); //Tem de passar como parametro o proprio objeto
        return($res);
    }

    public function delete(){
        return (ProdutoDAL::delete($this));
    }

    public static function retrieveAll(){
        return (ProdutoDAL::retrieveAll());
    }

    public function retrieveByName(){
        return (ProdutoDAL::retrieveByName($this));
    }

    public static function retrieveById($id){
        return (ProdutoDAL::retrieveById($id));
    }

    public function update(){
        return(ProdutoDAL::update($this));
    }

    public function validate($create){
        if(ProdutoDAL::validate($this, $create)==0){
            return TRUE;
        }
    }

    public static function pesquisa($palavra){
        return (ProdutoDAL::pesquisa($palavra));
    }
}
