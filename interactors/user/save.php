<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 25/04/2018
 * Time: 05:53 PM
 */

require_once "../conf.php";

$sql = "SELECT * FROM usuarios WHERE usuario = '{$_POST['user']}'";
$res = $conn -> query($sql);

if (!$res -> rowCount()) {
    if ($_POST['pass'] === $_POST['pass_conf']) {
        $sql = "INSERT INTO usuarios (usuario, pass, nombre, apaterno, amaterno, rol) VALUES
 ('{$_POST['user']}', '{$_POST['pass']}', '{$_POST['nombre']}', '{$_POST['apaterno']}', '{$_POST['apaterno']}', 'normal')";

        if ($conn -> exec($sql)) {
            sweetMessage('Guardado correctamente',
                'Se ha guardado el usuario con éxito.',
                'success',
                'all');
        } else {
            message('No se ha podido guardar el usuario.', 'alert alert-danger');
        }
    } else
        message('Las contraseñas no coinciden.', 'alert alert-danger');
} else
    message('El nombre de usuario ingresado ya existe.', 'alert alert-danger');
