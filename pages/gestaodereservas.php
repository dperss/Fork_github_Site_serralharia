<!DOCTYPE html>
<html class="" lang="pt"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="pt">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ramos: Serralharia Civil e Metalomecânica</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="icon" type="image/x-icon" href="../img/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.png">
    <link rel="stylesheet" type="text/css" media="screen" href="../CSS/bitnami.css">
    <style>@media print {#ghostery-purple-box {display:none !important}}</style><style type="text/css">.fancybox-margin{margin-right:17px;}</style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>



</head>
<body class="">
<div class="container conta">
    <div class="headerBar">
        <div class="row">

            <div class="headerLeft">
                <a href="index.html" title="Ramos"><img src="../img/Menu_image.png" alt="Logotipo Serralharia Ramos" title="Logotipo Serralharia Ramos" class="logo"></a>          </div>

            <div class="headerRight">

                <div class="headerUtils">
                    <div class="headerlogin">
                        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

                        <div id="id01" class="modal">

                            <form class="modal-content animate" action="/action_page.php">
                                <div class="imgcontainer">
                                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                                    <img src="../img/img_avatar2.png" alt="Avatar" class="avatar">
                                </div>

                                <div class="container5">

                                    <label for="uname"><b>Username</b></label>
                                    <input type="password" placeholder="Usuario" name="uname" required="">

                                    <label for="psw"><b>Password</b></label>
                                    <input type="password" placeholder="Password" name="psw" required="">

                                    <button type="submit">Login</button>
                                    <label>
                                        <input type="checkbox" checked="checked" name="remember"> Remember me
                                    </label>

                                </div>

                                <div class="container6" style="background-color:white">
                                    <a class="button-two" title="Esqueceu-se da password?" href="#">Esqueceu-se da password?</a>
                                    <a class="button-three" title="Registar" href="#">Registar</a>

                                </div>
                            </form>
                        </div>

                        <script>
                            // Get the modal
                            var modal = document.getElementById('id01');

                            // When the user clicks anywhere outside of the modal, close it
                            window.onclick = function(event) {
                                if (event.target == modal) {
                                    modal.style.display = "none";
                                }
                            }
                        </script>
                    </div>




                </div>

                <div class="headerMenu">
                    <div class="contentMenu">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle navbar-left collapsed" data-toggle="collapse" data-target="#menuPrincipal" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="collapse navbar-collapse" id="menuPrincipal">
                                    <ul class="nav navbar-nav">

                                        <li class="">
                                            <a href="index.php">Início</a>                                </li>
                                        <li class="">
                                            <a href="main/empresa.php">Empresa</a>                                </li>
                                        <li class="">
                                            <a href="produtos/Grades.php">Produtos</a>                                </li>
                                        <li class="">
                                            <a href="main(/erviços.php">Serviços</a>                                </li>
                                        <li class="">
                                            <a href="main/contactos.php">Contactos</a>                                </li>
                                    </ul>

                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>



<div class="rconta">
<hr>
<h1 align="center">Gestão de Reservas</h1>
<label for="restado"><strong>Estado da Reserva</strong></label>
<input type="text" id="restado"placeholder="Estado da Reserva">

<label for="prazo"><strong>Prazo de Entrega</strong></label>
<input type="text" id="prazo"placeholder="Prazo de Entrega">

<label for="Detalhes"><strong>Detalhes da Reserva</strong></label>
<input type="text" id="Detalhes"placeholder="Detalhes da Reserva">
<button class="button1">Editar</button> <button class="button1">Concluir</button>
<hr>
</div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <label for="Detalhes"><strong>Reserva Finalizada</strong></label>
                <hr>
                <input type="submit" id= "reserva" value="Sim"> <input type="submit" value="Nao">
            </div>
            <div class="col-sm-6">
                <label for="Detalhes"><strong>Reserva Atualizada</strong></label>
                <hr>
                <input type="submit" id= "reserva" value="Sim"> <input type="submit" value="Nao">
            </div>
            <div class="col-sm-6">
                <label for="Detalhes"><strong>Eliminar Reserva</strong></label>
                <hr>
                <input type="submit" id= "reserva" value="Sim"> <input type="submit" value="Nao">
            </div>

        </div>
    </div>




<div class="pie">
    <div class="container">
        © 2019 Serralharia RAMOS,Lda.
        <div class="menuPie">
            <a href="contactos.php" class="">Contacto</a>
            <a >Design by: Group 23</a>
        </div>
    </div>

</div>

</body></html>