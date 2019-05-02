<?php
require_once dirname(__FILE__).'/../DAL/ReservaDAL.php';
require_once dirname(__FILE__).'/../DAL/MensagemDAL.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reserva
 *
 * @author Diogo Ramos
 */
class Reserva {
    //put your code here
    public $id;
    public $data;
    public $mensagem_id;


    public function copy($row){
        $this->id=$row->id;
        $this->data=$row->data;
        $this->mensagem_id=$row->mensagem_id;
    }

    public function create(){
        $res=false;
        $res=ReservaDAL::create($this); //Tem de passar como parametro o proprio objeto
        return($res);
    }

    public function delete(){
        return (ReservaDAL::delete($this));
    }

    public static function retrieveAll(){
        return (ReservaDAL::retrieveAll());
    }

    public function retrieveByID(){
        return (ReservaDAL::retrieveByID($this));
    }

    public static function retrieveIdName(){
        return (ReservaDAL::retrieveIdName());
    }

    public function update(){
        return (ReservaDAL::update($this));
    }

    public function validate(){
        if(ReservaDAL::validate($this)==0)
            return TRUE;
    }

    public function nReservas(){
        return (ReservaDAL::nreservas($this));
    }
}
