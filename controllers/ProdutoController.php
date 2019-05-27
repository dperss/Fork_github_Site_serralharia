<?php
require_once dirname(__FILE__)."/../BL/Produto.php";

class ProdutoController {
    public static function getCRUDMenu(){
        $menu=[
            [
                'text' => 'Registar Produto',
                'url' => 'index.php?page=produto/registar',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "produto/registar";'
            ],
            [
                'text' => 'Remover Produto',
                'url' => 'index.php?page=produto/remover',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "produto/remover";'
            ],
            [
                'text' => 'Alterar Produto',
                'url' => 'index.php?page=produto/alterar',
                'visible' => 'return !isset($_GET["page"]) || $_GET["page"] != "produto/alterar";'
            ]
        ];
        return ($menu);
    }
    
    public static function process(&$msg, &$pesquisa){
        if(isset($_POST['form-produto'])){
            ProdutoController::createProduto($msg);
        }
        if(isset($_POST['form-produto-remove'])){
            ProdutoController::delete($msg);
        }
        if(isset($_POST['form-produto-update'])){
            ProdutoController::update($msg);
        }
        if(isset($_POST['form-produto-pesquisa'])){
            ProdutoController::pesquisa($pesquisa);
        }
    }
    
    public static function createProduto(&$msg){
        $produto= new Produto();
        $produto->nome=$_POST['nome'];
        $produto->Categoria_id=$_POST['Categoria_id'];
        $create=TRUE;//se for para criar registos na BD
        
        if($produto->validate($create)){
            $produto->create();
            $msg["sucesso"][]="Produto criado com sucesso";
        }else {
            $msg["insucesso"][] = 'Produto não criado';
            if ($produto->id == -1)
                $msg["insucesso"][] = 'O Produto "' . $produto->nome . '" já existe';
        }
    }
    
    public static function delete(&$msg){
        $produto= new Produto();
        $produto->id=$_POST['id'];
        $a=$produto->delete();
        if($a){
            $msg["sucesso"][]="Produto removido com sucesso";
        }else{
            $msg["insucesso"][]="Produto não removido.";
        }
    }
    
    public static function update(&$msg){
        $produto= new Produto();
        $produto->nome=$_POST['nome'];
        $produto->Categoria_id=$_POST['Categoria_id'];
        $create=FALSE;//se não for para criar registos na BD, apenas para alterar
        
        if($produto->validate($create)){
            $produto->update();
            $msg["sucesso"][]="Produto alterado com sucesso";
        }else{
            $msg["insucesso"][]="Produto não alterado";
        }
    }
    
    public static function pesquisa(&$pesquisa) {
        if(isset($_POST['consulta'])) {
            $busca = $_POST['consulta'];
            $sql=Produto::pesquisa($busca);            
            
            $comRegistos=TRUE;
            $registos=$sql;
            foreach($registos as $k => $v){
                $pesquisa[]=$v;
            }
            
            if(empty($pesquisa))
                    $comRegistos=FALSE;
            if(!$comRegistos){
                $_SESSION["insucesso"][]="Não existem registos com esse nome";
            }
        }
    }
}
