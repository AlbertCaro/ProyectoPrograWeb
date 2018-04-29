<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 25/04/2018
 * Time: 11:47 PM
 */

require_once "../conf.php";

$continue = true;
$sql = "UPDATE usuarios SET
  nombre = '{$_POST['nombre']}',
  apaterno = '{$_POST['apaterno']}',
  amaterno = '{$_POST['amaterno']}'";

if ($_POST['pass'] !== "") {
    if ($_POST['pass'] === $_POST['pass_conf']) {
        $sql .= ", pass = MD5('{$_POST['pass']}')";
    } else {
        $continue = false;
        message('Las contraseñas no coinciden.','alert alert-danger');
    }
}

$sql .= " WHERE idusuarios = '{$_POST['id']}'";

if ($continue) {
    if ($conn -> exec($sql)) {
        sweetMessage('Actualizado correctamente',
            'Se ha actualizado el artista con éxito.',
            'success',
            'all');
    } else {
        sweetMessage('No se ha actualizado',
            'Ah ocurrido un error o no se han hecho cambios.',
            'error',
            'all');
    }
}
