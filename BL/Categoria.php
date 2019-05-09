<?php
require_once dirname(__FILE__).'/../DAL/CategoriaDAL.php';
require_once dirname(__FILE__).'/../DAL/ProdutoDAL.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 * @author Diogo Ramos
 */
class Categoria {

    public $id;
    public $nome;

    public function copy($row){
        $this->id=$row->id;
        $this->nome=$row->nome;
    }

    public function create(){
        $res=false;
        $res=ProdutoDAL::create($this);
        return($res);
    }

    public function delete(){
        return (ProdutoDAL::delete($this));
    }

    public static function findAll(){
        return (ProdutoDAL::findAll());
    }

    public function findByName(){
        return (ProdutoDAL::findByName($this));
    }

    public static function findById($id){
        return (ProdutoDAL::findById($id));
    }

    public function update(){
        return(ProdutoDAL::update($this));
    }

    public function validate($create){
        if(ProdutoDAL::validate($this, $create)==0){
            return TRUE;
        }
    }

}