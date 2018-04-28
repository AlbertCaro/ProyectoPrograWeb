<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 22/04/2018
 * Time: 10:57 PM
 */

require_once "../../conf.php";

session_start();
$_SESSION = [];

if (session_destroy()) {
    if ($_POST['count'] > 3)
        sweetMessage('Aviso', 'Se ha cerrado la sesión', 'info', 'index');
    else
        redirect("Se ha cerrado sesión.", "index");
}