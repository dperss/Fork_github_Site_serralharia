<?php
require_once dirname(__FILE__)."/DB.php";
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
class UtilizadorDAL {
    public static function create($e, $num){
        
        $db=DB::getDB();
        $query="INSERT INTO Utilizador (nome , email, password,endereco,Tipo_de_Utilizador,NIF) "."VALUES (:nome, :email, :password,:endereco,Tipo_de_Utilizador,NIF)";
        $parms=[
            'nome' => $e->nome,
            'email' => $e->email,
            'password' => $e->password,
            'endereco' => $e->endereco,
            'Tipo_de_Utilizador' => $num
            'NIF' => $e->NIF,
        ];
        $res=$db->query($query,$parms);
        if($res){
            $e->id=$db->lastInsertId();
        }
        return($res);
    }
    
    public static function delete($e){
        $db=DB::getDB();
        $query="DELETE FROM Utilizador WHERE id = :id";
        $parms=[
            'id' => $e->id
        ];
        $res=$db->query($query,$parms);
        
        return($res);
    }
    
    public static function retrieveAll(){
        $db=DB::getDB();
        $query="SELECT * FROM Utilizador";
        
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        return($res);
    }
    
    public static function retrieveByEmail($e){
        $db=DB::getDB();
        $query="SELECT * FROM Utilizador WHERE email=:email";
        $parms=[
            'email' => $e->email
        ];
        $res=$db->query($query,$parms);
        $res->setFetchMode(PDO::FETCH_CLASS,"Utilizador"); //Para podermos usar a notacao de objeto em vez de array
        $row=$res->fetch(); //Como o name é unico so pode dar 1 valor ou 0 logo podemos fazer o fetch de um so valor em vez de um while
        if($row){   //Com isto inserimos os atributos da BD na instancia criada no index que entra neste metodo
            $e->copy($row);
        }
        return($row);
    }
    
    public static function retrieveByLoginPassword($e){
        $db=DB::getDB();
        $query="SELECT * FROM Utilizador WHERE email=:email and password=:password";
        $params=[
            ':email' => $e->email,
            ':password' => $e->password
        ];
        $res=$db->query($query, $params);
        $res->setFetchMode(PDO::FETCH_CLASS, "Utilizador");
        $row=$res->fetch();
        if($row){
            $e->copy($row);
        }
        return($row);
    }
    
    public static function retrieveById($e){
        $db=DB::getDB();
        $query="SELECT id FROM Utilizador WHERE email=:email and password=:password";
        $params=[
            ':email' => $e->email,
            ':password' => $e->password
        ];
        $res=$db->query($query, $params);
        $res->setFetchMode(PDO::FETCH_CLASS, "Utilizador");
        $row=$res->fetch();
        if($row){
            $e->copy($row);
        }
        return($row);
    }
    
    public static function nUtilizadores($e){ //Conta o número de utilizadores na base de dados
        $db=DB::getDB();
        $query="SELECT count(*) FROM Utilizador";
        $res=$db->query($query);
        $nFuncionarios=$res->fetchColumn();
        return($nFuncionarios);
    }
    
    public static function retrieveIdName(){
        $db=DB::getDB();
        $query="SELECT id, login FROM Utilizador ORDER BY id";
        $res=$db->query($query);
        $res->setFetchMode(PDO::FETCH_ASSOC); //Devolve um array associativo entre id e login
        return $res;
    }
    
    public static function update($e){
        $db=DB::getDB();
        $query="UPDATE utilizador set login=:login, password=:password, admin=:admin WHERE id=:id";
        $params=[
            ':login' => $e->login,
            ':password' => $e->password,
            ':admin' => $e->admin,
            ':id' => $e->id
        ];
        $res=$db->query($query, $params);
        
        return($res);
    }
    
    public static function validate($e, $create){
        $db=DB::getDB();
        if($create)
            if(UtilizadorDAL::retrieveByName($e))
                return ($e->id=-1);
        return 0;
    }
    
    public static function isAdmin(){
        $db=DB::getDB();
        $sql="SELECT admin FROM utilizador WHERE id=".$_SESSION['id'];
        $res=$db->query($sql);
        $row=$res->fetchcolumn();
        return $row;
    }
}
