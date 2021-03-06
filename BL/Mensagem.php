<?php
require_once dirname(__FILE__).'/../DAL/MensagemDAL.php';
require_once dirname(__FILE__).'/../DAL/UtilizadorDAL.php';
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
class Mensagem {

    public $id;
    public $assunto;
    public $utilizador_id;
    public $data;
    public $mensagem;


    public function copy($row){
        $this->id=$row->id;
        $this->assunto=$row->assunto;
        $this->utilizador_id=$row->utilizador_id;
        $this->data=$row->data;
        $this->mensagem=$row->mensagem;
    }

    public function create(){
        $res=false;
        $res=MensagemDAL::create($this);
        return($res);
    }

    public function delete(){
        return (MensagemDAL::delete($this));
    }

    public static function findAll(){
        return (MensagemDAL::findAll());
    }

    public function findByData(){
        return (MensagemDAL::findByData($this));
    }

    public function findByAssunto(){
        return (MensagemDAL::findByAssunto($this));
    }

    public static function findById($id){
        return (MensagemDAL::findById($id));
    }

    public function update(){
        return(MensagemDAL::update($this));
    }

    public function validate($create){
        if(MensagemDAL::validate($this, $create)==0){
            return TRUE;
        }
    }


}