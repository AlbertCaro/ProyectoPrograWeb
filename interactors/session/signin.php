<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 22/04/2018
 * Time: 10:13 PM
 */

include "../conf.php";

$continue = detectEmptyRows($_POST);

if($continue) {
    $sql = "SELECT * FROM usuarios WHERE pass = MD5('{$_POST['pass']}') AND usuario = '{$_POST['user']}'";
    $res = $conn -> query($sql);
    $count = $res -> rowCount();

    if ($count !== 0) {
        $data = $res -> fetchAll()[0];
        session_start();
        $_SESSION['valid'] = true;
        $_SESSION['user'] = "{$data['nombre']} {$data['apaterno']} {$data['amaterno']}";
        $_SESSION['role'] = $data['rol'];
        sweetMessage("Se ha iniciado sesión","Bienvenido {$_SESSION['user']}", "success", "index");
    } else
        message('Credenciales incorrectas.', "alert alert-danger");
} else
    message('Ha dejado campos vacíos.', "alert alert-danger");