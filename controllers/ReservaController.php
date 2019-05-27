<?php
require_once dirname(__FILE__)."/../BL/Reserva.php";

class ReservaController {
    public static function getCRUDMenu(){
        $menu=[
            [
                'text' => 'Registar Reserva',
                'url' => 'index.php?page=reserva/registar',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "reserva/registar";'
            ],
            [
                'text' => 'Remover Reserva',
                'url' => 'index.php?page=reserva/remover',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "reserva/remover";'
            ],
            [
                'text' => 'Alterar Reserva',
                'url' => 'index.php?page=reserva/alterar',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "reserva/alterar";'
            ]
        ];
        return ($menu);
    }

    public static function process(&$msg, &$pesquisa){
        if(isset($_POST['form-reserva'])){
            ReservaController::createReserva($msg);
        }
        if(isset($_POST['form-reserva-remove'])){
            ReservaController::delete($msg);
        }
        if(isset($_POST['form-reserva-update'])){
            ReservaController::update($msg);
        }
    }

    public static function createReserva(&$msg){
        $reserva= new Reserva();
        $reserva->data=$_POST['data'];
        $reserva->mensagem_id=$_POST['mensagem_id'];
        $create=TRUE;//se for para criar registos na BD

        if($reserva->validate($create)){
            $reserva->create();
            $msg["sucesso"][]="Reserva criado com sucesso";
        }else {
            $msg["insucesso"][] = 'Reserva não criado';
        }
    }

    public static function delete(&$msg){
        $reserva= new Reserva();
        $reserva->id=$_POST['id'];
        $a=$reserva->delete();
        if($a){
            $msg["sucesso"][]="Reserva removido com sucesso";
        }else{
            $msg["insucesso"][]="Reserva não removido.";
        }
    }

    public static function update(&$msg){
        $reserva= new Reserva();
        $reserva->data=$_POST['data'];
        $reserva->mensagem_id=$_POST['mensagem_id'];
        $create=FALSE;//se não for para criar registos na BD, apenas para alterar

        if($reserva->validate($create)){
            $reserva->update();
            $msg["sucesso"][]="Reserva alterado com sucesso";
        }else{
            $msg["insucesso"][]="Reserva não alterado";
        }
    }

}
