<?php
require_once dirname(__FILE__).'/../DAL/Produtos_ReservadosDAL.php';
require_once dirname(__FILE__).'/../DAL/ProdutoDAL.php';
require_once dirname(__FILE__).'/../DAL/ReservaDAL.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produtos_Reservados
 *
 * @author Diogo Ramos
 */
class Produtos_Reservados {
    //put your code here
    public $preço;
    public $medidas;
    public $quantidade;
    public $produto_id;
    public $reserva_id;

    public function _construct(){
        $this->reserva_id=new Reserva();
        $this->produto_id=new Produto();
    }
    public function copy($row){
        $this->preço=$row->preço;
        $this->medidas=$row->medidas;
        $this->quantidade=$row->quantidade;
        $this->produto_id=$row->produto_id;
        $this->reserva_id=$row->reserva_id;
    }

    public function create(){
        $res=false;
        $res=Produtos_ReservadosDAL::create($this); //Tem de passar como parametro o proprio objeto
        return($res);
    }

    public function delete(){
        return (Produtos_ReservadosDAL::delete($this));
    }

    public static function retrieveAll(){
        return (Produtos_ReservadosDAL::retrieveAll());
    }

    public function retrieveByID(){
        return (Produtos_ReservadosDAL::retrieveByID($this));
    }

    public static function retrieveByName(){
        return (Produtos_ReservadosDAL::retrieveByName());
    }

    public static function retrieveIdName(){
        return (Produtos_ReservadosDAL::retrieveIdName());
    }


    public function update(){
        return (Produtos_ReservadosDAL::update($this));
    }

    public function validate(){
        if(Produtos_ReservadosDAL::validate($this)==0)
            return TRUE;
    }


}