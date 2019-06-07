<?php
require_once '../controllers/UtilizadorController.php';
require_once $_SERVER['DOCUMENT_ROOT']. '../controllers/UtilizadorController.php';
?>
<div id="CRUDMenu">
    <ul>
        <?php
        $menu= UtilizadorController::getCRUDMenu();
        foreach($menu as $item){
            if(eval($item['visible'])==true)
                echo '<li><a href="'.$item['url'].'">'.$item['text'].'</a></li>';
        }
        ?>
    </ul>
</div>
<h1>Registar Utilizador</h1>

<?php
$nUtilizadores= UtilizadorController::nUtilizadores();
if($nUtilizadores){ //Se não houver funcionários na BD, vai a form create, para inserir o primeiro na BD, que
    goto registar;     //será forçosamente admin.
}
if(isset($_SESSION['id'])){
    if(UtilizadorController::isAdmin()){
        registar:
        ?>
        <form method="post" class="create">
            <label for="nome"><strong>Primeiro Nome</strong></label>
            <input type="text" id="nome"placeholder="Nome...">
            <label for="tel"><strong>Telefone</strong></label>
            <input type="text" id="tel"placeholder="Telefone">
            <label for="morada"><strong>Morada</strong></label>
            <input type="text" id="morada"placeholder="Morada">
            <label for="nif"><strong>NIF</strong></label>
            <input type="text" id="nif" placeholder="NIF">
            <label for="email"><strong>Email</strong></label>
            <input type="text" id="email"placeholder="Email">
            <label for="senha"><strong>Senha</strong></label>
            <input type="text" id="senha" placeholder="**********">
            <label for="rsenha"><strong>Repita a Senha</strong></label>
            <input type="text" id="rsenha" placeholder="**********">
            <p>Ao criar uma conta, voce concorda com os nossos Termos e Privacidade.</p>
            <input type="submit" name="form-utilizador" value="Registar Utilizador" id="registar"/>
            <input type="reset" name="reset" value="Reset"\>
            </div>
        </form>
        <?php
    }else{
        echo '<div id=insucesso>Não tem permissões para aceder</div>';
    }
}else{
    echo '<div id=insucesso>Por favor entre com a sua conta</div>';
}
?>



