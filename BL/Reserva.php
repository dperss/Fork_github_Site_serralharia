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
        $res=ReservaDAL::create($this);
        return($res);
    }

    public function delete(){
        return (ReservaDAL::delete($this));
    }

    public static function findAll(){
        return (ReservaDAL::findAll());
    }

    public function findByData(){
        return (ReservaDAL::findByData($this));
    }

    public function findByID(){
        return (ReservaDAL::findByID($this));
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
