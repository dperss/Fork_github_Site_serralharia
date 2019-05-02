<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB
 *
 * @author Diogo Ramos
 */
class DB {
    //put your code here

    private static $instance=null;
    private $conn;

    private function __construct(){
        try{
            $this->conn=new PDO("mysql:host=localhost;dbname=serr;charset=UTF8","adm_1","adm_1");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }catch (PDOException $e){
            echo $e->getMessage();
            exit();
        }
    }

    public function __destruct() {
        if(self::$instance!=NULL){
            $this->conn=NULL;
            self::$instance=NULL;
        }
    }

    public static function getDB(){
        if(self::$instance == NULL){
            self::$instance=new self(); // ou new DB()
        }

        return (self::$instance);

    }

    public function query($query,$parms = []){
        $statement= $this->conn->prepare($query);
        $statement->execute($parms);
        return($statement);
    }

    public function lastInsertId(){
        return ($this->conn->lastInsertId());
    }
}
