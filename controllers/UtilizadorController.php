<?php
require_once dirname(__FILE__)."../BL/Utilizador.php";

class UtilizadorController {

    public static function getCRUDMenu(){
        $menu=[
            [
                'text' => 'Registar Utilizador',
                'url' => 'index.php?page=utilizador/registar',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "utilizador/registar";'
            ],
            [
                'text' => 'Remover Utilizador',
                'url' => 'index.php?page=utilizador/remover',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "utilizador/remover";'
            ],
            [
                'text' => 'Alterar Utilizador',
                'url' => 'index.php?page=utilizador/alterar',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "utilizador/alterar";'
            ]
        ];
        return ($menu);
    }
    
    public static function process(&$msg){
        if(isset($_POST['form-utilizador'])){
            UtilizadorController::createUtilizador($msg);
        }else if(isset($_POST['form-Login'])){
            UtilizadorController::login($msg);
        }else if(isset($_POST['form-Logout'])){
            UtilizadorController::logout();
        }else if(isset($_POST['form-utilizador-remove'])){
            UtilizadorController::delete($msg);
        }else if(isset($_POST['form-utilizador-update'])){
            UtilizadorController::update($msg);
        }
        
    }
    
    public static function createUtilizador(&$msg){
        $utilizador= new Utilizador();
        $utilizador->nome=$_POST['nome'];
        $utilizador->email=$_POST['email'];
        $utilizador->password=$_POST['password'];
        $utilizador->id=$_POST['id'];
        $utilizador->endereco=$_POST['endereco'];
        $utilizador->Tipo_de_Utilizador=$_POST['Tipo_de_Utilizador'];
        $utilizador->NIF=$_POST['NIF'];
        $create=TRUE;//se for para criar registos na BD
       
        if($utilizador->validate($create)){
            $utilizador->create();
            $_SESSION["sucesso"][]="Utilizador criado com sucesso";
            if($utilizador->nUtilizadores()!=1){
                header("Location: index.php?page=utilizador/registar");
                exit;
            }else{
                header("Location: index.php"); //Direciona a página para o index
                exit;
            }
        }else{
            $msg["insucesso"][]='Utilizador não criado';
            if($utilizador->id==-1)
                $msg["insucesso"][]='O login "'.$utilizador->login.'" já existe!';
        }
    }
    
    public static function login(&$msg){
        $user= new Utilizador();
        $user->email=$_POST['email'];
        $user->password=$_POST['password'];
        $a=$user->retrieveByLoginPassword();
        
        if($a){
            $_SESSION["sucesso"][]="Login efetuado com sucesso";
            $id=$user->retrieveById();
            $_SESSION['id']=$id->id;
            header("Location: index.php");
            exit;
            
        }else{
            $msg["insucesso"][]="Login não efetuado";
        }
    }
    
    public static function logout(){
        $_SESSION['id']=null;
        header("Location: index.php");
    }

    public static function nUtilizadores(){
        $utilizador= new Utilizador();
        $nUtilizadores=$utilizador->nUtilizadores();
        return $nUtilizadores;
    }

    public static function delete(&$msg){
        $utilizador= new Utilizador();
        $utilizador->id=$_POST['id'];
        $a=$utilizador->delete();
        if($a){
            $msg["sucesso"][]="Utilizador removido com sucesso";
        }else{
            $msg["insucesso"][]="Utilizador não removido.";
        }
    }

    public static function update(&$msg){
        $utilizador= new Utilizador();
        $utilizador->nome=$_POST['nome'];
        $utilizador->email=$_POST['email'];
        $utilizador->password=$_POST['password'];
        $utilizador->id=$_POST['id'];
        $utilizador->endereco=$_POST['endereco'];
        $utilizador->Tipo_de_Utilizador=$_POST['Tipo_de_Utilizador'];
        $utilizador->NIF=$_POST['NIF'];
        $create=FALSE;//se não for para criar registos na BD, apenas para alterar
        
        if($utilizador->validate($create)){
            $utilizador->update();
            $_SESSION["sucesso"][]="Utilizador criado com sucesso";
        }else{
            $msg["insucesso"][]='Utilizador não alterado';
            if($utilizador->id==-1)
                $msg["insucesso"][]='O login "'.$utilizador->login.'" já existe!';
        }
    }
    
    public static function isAdmin(){
        return Utilizador::isAdmin();
    }
}
