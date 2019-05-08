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


    public function copy($row){
        $this->id=$row->id;
        $this->assunto=$row->assunto;
        $this->utilizador_id=$row->utilizador_id;
        $this->data=$row->data;
    }

    public function create(){
        $res=false;
        $res=MensagemDAL::create($this); //Tem de passar como parametro o proprio objeto
        return($res);
    }

    public function delete(){
        return (MensagemDAL::delete($this));
    }

    public static function retrieveAll(){
        return (MensagemDAL::retrieveAll());
    }

    public function retrieveByData(){
        return (MensagemDAL::retrieveByData($this));
    }

    public static function retrieveById($id){
        return (MensagemDAL::retrieveById($id));
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