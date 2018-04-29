<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 12:01 PM
 */

require_once "conf.php";

$function = $_POST['func'];
$function($conn, $_POST);

function signin($conn) {
    $sql = "SELECT * FROM usuarios WHERE pass = MD5('{$_POST['pass']}') AND usuario = '{$_POST['user']}'";
    $res = $conn -> query($sql);
    $count = $res -> rowCount();

    if ($count !== 0) {
        $data = $res -> fetchAll()[0];
        session_start();
        $_SESSION['valid'] = true;
        $_SESSION['user'] = "{$data['nombre']} {$data['apaterno']} {$data['amaterno']}";
        $_SESSION['role'] = $data['rol'];
        sweetMessage("Se ha iniciado sesión","Bienvenido {$_SESSION['user']}", "success", "../");
    } else
        message('Credenciales incorrectas.', "alert alert-danger");
}

function logout() {
    session_start();
    $_SESSION = [];

    if (session_destroy()) {
        if ($_POST['count'] > 3)
            sweetMessage('Aviso', 'Se ha cerrado la sesión', 'info', '../');
        else
            redirect("Se ha cerrado sesión.", "");
    }
}