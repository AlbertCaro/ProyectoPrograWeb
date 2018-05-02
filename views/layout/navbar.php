<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 27/04/2018
 * Time: 09:46 AM
 */

$array = explode('/', $_SERVER['REQUEST_URI']);

$dots = "";
if (count($array) > 3)
    $dots = "../";

?>
<!DOCTYPE HTML>
<!--
	Introspect by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
<head>
    <title><?php echo $title ?> - Musical</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link href="<?php echo $dots ?>assets/img/favicon.ico" rel="icon">
    <link href="<?php echo $dots ?>assets/css/jquery-ui.min.css">
    <link href="<?php echo $dots ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $dots ?>assets/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $dots ?>assets/css/main.css" />
    <script src="<?php echo $dots ?>assets/js/functions.js"></script>
    <script src="<?php echo $dots ?>assets/js/node_modules/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo $dots ?>assets/js/jquery.js"></script>
    <script src="<?php echo $dots ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo $dots ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo $dots ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $dots ?>assets/js/year-select.js"></script>
    <script src="<?php echo $dots ?>assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo $dots ?>assets/js/locale/bootstrap-datepicker.es.min.js"></script>
    <script src="<?php echo $dots ?>assets/js/node_modules/jquery-validation/dist/jquery.validate.js"></script>
    <script src="<?php echo $dots ?>assets/js/node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo $dots ?>assets/js/node_modules/jquery-validation/dist/additional-methods.js"></script>
    <script src="<?php echo $dots ?>assets/js/countrypicker.js"></script>
    <script src="<?php echo $dots ?>assets/js/countrypicker.min.js"></script>
</head>
<body>

<!-- Header -->
<header id="header">
    <div class="inner">
        <a href="<?php echo $dots ?>" class="logo">Musical</a>
        <nav id="nav">
            <?php
            if(isset($_SESSION['valid'])) {
                echo '
                    <div class="dropdown inline-div">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Artistas<span class="caret"></span></a>
                        <ul class="dropdown-menu">';
                if ($_SESSION['role'] === 'admin')
                    echo '<li><a class="dropdown-item" style="color:#000;" href="'.$dots.'artist/">Agregar</a></li>';
                echo '
                            <li><a class="dropdown-item" style="color:#000;" href="'.$dots.'artist/all">Ver todos</a></li>
                         </ul>
                    </div>
                    <div class="dropdown inline-div">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Canciones<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" style="color:#000;" href="'.$dots.'favorites/">Favoritas</a></li>';
                if ($_SESSION['role'] === 'admin')
                    echo '<li><a class="dropdown-item" style="color:#000;" href="'.$dots.'song/">Agregar</a></li>';
                echo '
                            <li><a class="dropdown-item" style="color:#000;" href="'.$dots.'song/all">Ver todos</a></li>
                        </ul>
                    </div>
                    <div class="dropdown inline-div">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Albumes<span class="caret"></span></a>
                        <ul class="dropdown-menu">';
                if ($_SESSION['role'] === 'admin')
                    echo '<li><a class="dropdown-item" style="color:#000;" href="'.$dots.'album/">Agregar</a></li>';
                echo '
                            <li><a class="dropdown-item" style="color:#000;" href="'.$dots.'album/all">Ver todos</a></li>
                        </ul>
                    </div>
                    <div class="dropdown inline-div">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Disqueras<span class="caret"></span></a>
                        <ul class="dropdown-menu">';
                if ($_SESSION['role'] === 'admin')
                    echo '<li><a class="dropdown-item" style="color:#000;" href="'.$dots.'label/">Agregar</a></li>';
                echo '
                            <li><a class="dropdown-item" style="color:#000;" href="'.$dots.'label/all">Ver todos</a></li>
                        </ul>
                    </div>
                    <div class="dropdown inline-div">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Generos<span class="caret"></span></a>
                        <ul class="dropdown-menu">';
                if ($_SESSION['role'] === 'admin')
                    echo '<li><a class="dropdown-item" style="color:#000;" href="'.$dots.'genre/">Agregar</a></li>';
                echo '
                            <li><a class="dropdown-item" style="color:#000;" href="'.$dots.'genre/all">Ver todos</a></li>
                        </ul>
                    </div>';

                if ($_SESSION['role'] === "admin") {
                    echo '
                    <div class="dropdown inline-div">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" style="color:#000;" href="'.$dots.'user/">Agregar</a></li>
                            <li><a class="dropdown-item" style="color:#000;" href="'.$dots.'user/all">Ver todos</a></li>
                        </ul>
                    </div>';
                }
            }
            if (isset($_SESSION['valid']))
                echo "<a href='#' onclick='logout(event)'>Salir</a>";
            else
                echo "<a href='{$dots}login/'>Iniciar sesión</a>";
            ?>
        </nav>
    </div>
</header>
<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>
