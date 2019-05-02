<?php
    require_once dirname(__FILE__).'/../DAL/UtilizadorDAL.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utilizador
 *
 * @author Diogo Ramos
 */
class Utilizador {
    //put your code here
    public $id;
    public $nome;
    public $email;
    public $password;
    public $endereco;
    public $Tipo_de_Utilizador;
    public $NIF;

    
    public function copy($row){
            $this->id=$row->id;
            $this->nome=$row->nome;
            $this->email=$row->emai;
            $this->password=$row->password;
            $this->endereco=$row->endereco;
            $this->Tipo_de_Utilizador=$row->Tipo_de_Utilizador;
            $this->NIF=$row->NIF;
    }
    
    public function create(){
        $res=false;
        $db=DB::getDB();        
        $num= UtilizadorDAL::nUtilizadores($this);
        if($num==0) $num=1; //Caso nao hajam utilizadores na base de dados o proximo user a ser criado terá o parametro Admin=1
        else  $num=0; //Caso contrario(Ja existam users na BD) todos os users serao criados com o parametro Admin=0
        $res=UtilizadorDAL::create($this, $num); //Tem de passar como parametro o proprio objeto
        return($res);
    }
    
    public function delete(){
        return (UtilizadorDAL::delete($this));
    }
    
    public static function retrieveAll(){
        return (UtilizadorDAL::retrieveAll());
    }
    
    public function retrieveByEmail(){
        return (UtilizadorDAL::retrieveByemail($this));
    }
    
    public function retrieveByemailPassword(){
        return(UtilizadorDAL::retrieveByemailPassword($this));
    }
    
    public function retrieveById(){
        return(UtilizadorDAL::retrieveById($this));
    }
    
    public function nUtilizadores(){
        return(UtilizadorDAL::nUtilizadores($this));
    }
    
    public static function retrieveIdName(){
        return (UtilizadorDAL::retrieveIdName());
    }
    
    public function update(){
        return (UtilizadorDAL::update($this));
    }
    
    public function validate($create){
        if(UtilizadorDAL::validate($this, $create)==0)
            return TRUE;
    }
    
    public static function isAdmin(){
        return(UtilizadorDAL::isAdmin());
    }
}
