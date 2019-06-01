<?php
require_once dirname(__FILE__)."../BL/Mensagem.php";

class MensagemController {
    public static function getCRUDMenu(){
        $menu=[
            [
                'text' => 'Registar Mensagem',
                'url' => 'index.php?page=mensagem/registar',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "mensagem/registar";'
            ],
            [
                'text' => 'Remover Mensagem',
                'url' => 'index.php?page=mensagem/remover',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "mensagem/remover";'
            ],
            [
                'text' => 'Alterar Mensagem',
                'url' => 'index.php?page=mensagem/alterar',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "mensagem/alterar";'
            ]
        ];
        return ($menu);
    }

    public static function process(&$msg, &$pesquisa){
        if(isset($_POST['form-mensagem'])){
            MensagemController::createMensagem($msg);
        }
        if(isset($_POST['form-mensagem-remove'])){
            MensagemController::delete($msg);
        }
        if(isset($_POST['form-mensagem-update'])){
            MensagemController::update($msg);
        }
    }

    public static function createMensagem(&$msg){
        $mensagem= new Mensagem();
        $mensagem->assunto=$_POST['assunto'];
        $mensagem->utilizador_id=$_POST['utilizador_id'];
        $mensagem->data=$_POST['data'];
        $mensagem->mensagem=$_POST['mensagem'];

        $create=TRUE;//se for para criar registos na BD

        if($mensagem->validate($create)){
            $mensagem->create();
            $msg["sucesso"][]="Mensagem criado com sucesso";
        }else {
            $msg["insucesso"][] = 'Mensagem não criado';
        }
    }

    public static function delete(&$msg){
        $mensagem= new Mensagem();
        $mensagem->id=$_POST['id'];
        $a=$mensagem->delete();
        if($a){
            $msg["sucesso"][]="Mensagem removido com sucesso";
        }else{
            $msg["insucesso"][]="Mensagem não removido.";
        }
    }

    public static function update(&$msg){
        $mensagem= new Mensagem();
        $mensagem->assunto=$_POST['assunto'];
        $mensagem->utilizador_id=$_POST['utilizador_id'];
        $mensagem->data=$_POST['data'];
        $mensagem->mensagem=$_POST['mensagem'];
        $create=FALSE;//se não for para criar registos na BD, apenas para alterar

        if($mensagem->validate($create)){
            $mensagem->update();
            $msg["sucesso"][]="Mensagem alterado com sucesso";
        }else{
            $msg["insucesso"][]="Mensagem não alterado";
        }
    }

}
