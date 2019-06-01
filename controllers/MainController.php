<?php
require_once dirname(__FILE__)."/CategoriaController.php";
require_once dirname(__FILE__)."/MensagemController.php";
require_once dirname(__FILE__)."/ProdutoController.php";
require_once dirname(__FILE__)."/Produtos_ReservadosController.php";
require_once dirname(__FILE__)."/ReservaController.php";
require_once dirname(__FILE__)."/UtilizadorController.php";
date_default_timezone_set('Europe/Lisbon'); //Fuso horário de Lisboa

class MainController {
    //put your code here
    public static function process(&$msg){
        CategoriaController::process($msg);
        MensagemController::process($msg);
        ProdutoController::process($msg);
        Produtos_ReservadosController::process($msg);
        ReservaController::process($msg);
        UtilizadorController::process($msg);
    }
    
    public static function getMainMenu(){
        $menu=[
            [
                'text' => 'Utilizador',
                'url' => 'index.php?page=utilizador/utilizadores',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"]!="utilizador/utilizadores";'
            ],
            [
                'text' => 'Empresa',
                'url' => 'index.php?page=empresa/empresas',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"]!="empresa/empresas";'
            ],
            [
                'text' => 'Homepage',
                'url' => 'index.php',
                'visible' => 'return true;'
            ]

        ];

        return ($menu);
    }


    
    public static function teste(){
        echo "teste";
    }
    
    public static function login(){
        if(!isset($_SESSION['id']))
            return TRUE;
        else return FALSE;
    }
}