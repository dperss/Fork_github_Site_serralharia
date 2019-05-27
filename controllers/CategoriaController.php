<?php
require_once dirname(__FILE__)."/../BL/Categoria.php";

class CategoriaController {
    public static function getCRUDMenu(){
        $menu=[
            [
                'text' => 'Registar Categoria',
                'url' => 'index.php?page=categoria/registar',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "categoria/registar";'
            ],
            [
                'text' => 'Remover Categoria',
                'url' => 'index.php?page=categoria/remover',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "categoria/remover";'
            ],
            [
                'text' => 'Alterar Categoria',
                'url' => 'index.php?page=categoria/alterar',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "categoria/alterar";'
            ]
        ];
        return ($menu);
    }

    public static function process(&$msg, &$pesquisa){
        if(isset($_POST['form-categoria'])){
            CategoriaController::createCategoria($msg);
        }
        if(isset($_POST['form-categoria-remove'])){
            CategoriaController::delete($msg);
        }
        if(isset($_POST['form-categoria-update'])){
            CategoriaController::update($msg);
        }
    }

    public static function createCategoria(&$msg){
        $categoria= new Categoria();
        $categoria->nome=$_POST['nome'];
        $categoria->Categoria_id=$_POST['Categoria_id'];
        $create=TRUE;//se for para criar registos na BD

        if($categoria->validate($create)){
            $categoria->create();
            $msg["sucesso"][]="Categoria criado com sucesso";
        }else{
            $msg["insucesso"][]='Categoria não criado';
            if($categoria->id==-1)
                $msg["insucesso"][]='O Categoria "'.$categoria->nome.'" já existe';
        }
    }

    public static function delete(&$msg){
        $categoria= new Categoria();
        $categoria->id=$_POST['id'];
        $a=$categoria->delete();
        if($a){
            $msg["sucesso"][]="Categoria removido com sucesso";
        }else{
            $msg["insucesso"][]="Categoria não removido.";
        }
    }

    public static function update(&$msg){
        $categoria= new Categoria();
        $categoria->nome=$_POST['nome'];
        $categoria->Categoria_id=$_POST['Categoria_id'];
        $categoria->id=$_POST['id'];
        $create=FALSE;//se não for para criar registos na BD, apenas para alterar

        if($categoria->validate($create)){
            $categoria->update();
            $msg["sucesso"][]="Categoria alterado com sucesso";
        }else{
            $msg["insucesso"][]="Categoria não alterado";
        }
    }

}
