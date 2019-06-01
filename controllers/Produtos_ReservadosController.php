<?php
require_once dirname(__FILE__)."../BL/Produtos_Reservados.php";

class Produtos_ReservadosController {
    public static function getCRUDMenu(){
        $menu=[
            [
                'text' => 'Registar Produtos_Reservados',
                'url' => 'index.php?page=produtos_reservados/registar',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "produtos_reservados/registar";'
            ],
            [
                'text' => 'Remover Produtos_Reservados',
                'url' => 'index.php?page=produtos_reservados/remover',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "produtos_reservados/remover";'
            ],
            [
                'text' => 'Alterar Produtos_Reservados',
                'url' => 'index.php?page=produtos_reservados/alterar',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "produtos_reservados/alterar";'
            ]
        ];
        return ($menu);
    }

    public static function process(&$msg, &$pesquisa){
        if(isset($_POST['form-produtos_reservados'])){
            Produtos_ReservadosController::createProdutos_Reservados($msg);
        }
        if(isset($_POST['form-produtos_reservados-remove'])){
            Produtos_ReservadosController::delete($msg);
        }
        if(isset($_POST['form-produtos_reservados-update'])){
            Produtos_ReservadosController::update($msg);
        }
    }

    public static function createProdutos_Reservados(&$msg){
        $produtos_reservados= new Produtos_Reservados();
        $produtos_reservados->preço=$_POST['preço'];
        $produtos_reservados->medidas=$_POST['medidas'];
        $produtos_reservados->quantidade=$_POST['quantidade'];
        $produtos_reservados->produto_id=$_POST['produto_id'];
        $produtos_reservados->reserva_id=$_POST['reserva_id'];
        $create=TRUE;//se for para criar registos na BD

        if($produtos_reservados->validate($create)){
            $produtos_reservados->create();
            $msg["sucesso"][]="Produtos_Reservados criado com sucesso";
        }else {
            $msg["insucesso"][] = 'Produtos_Reservados não criado';
        }
    }

    public static function delete(&$msg){
        $produtos_reservados= new Produtos_Reservados();
        $produtos_reservados->id=$_POST['id'];
        $a=$produtos_reservados->delete();
        if($a){
            $msg["sucesso"][]="Produtos_Reservados removido com sucesso";
        }else{
            $msg["insucesso"][]="Produtos_Reservados não removido.";
        }
    }

    public static function update(&$msg){
        $produtos_reservados= new Produtos_Reservados();
        $produtos_reservados->preço=$_POST['preço'];
        $produtos_reservados->medidas=$_POST['medidas'];
        $produtos_reservados->quantidade=$_POST['quantidade'];
        $produtos_reservados->produto_id=$_POST['produto_id'];
        $produtos_reservados->reserva_id=$_POST['reserva_id'];
        $create=FALSE;//se não for para criar registos na BD, apenas para alterar

        if($produtos_reservados->validate($create)){
            $produtos_reservados->update();
            $msg["sucesso"][]="Produtos_Reservados alterado com sucesso";
        }else{
            $msg["insucesso"][]="Produtos_Reservados não alterado";
        }
    }

}
