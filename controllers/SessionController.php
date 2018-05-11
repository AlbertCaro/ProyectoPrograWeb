<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 12:01 PM
 */

require_once "../database/conf.php";
require_once "../models/Session.php";

$function = $_POST['func'];
$function($conn, $_POST);

function signin($conn) {
    $session = new Session($conn, $_POST['user'], $_POST['pass']);
    if ($session->verifyCredentials()) {
        $data = $session->get();
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