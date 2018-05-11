<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:05 AM
 */

require_once "../database/conf.php";
require_once "../models/User.php";

$function = $_POST['func'];
$function($conn);

function table($conn) {
    $res = User::searchArtist($conn, $_POST['search']);
    $count = $res -> rowCount();
    echo $count;
    require_once "../views/user/row.php";
}

function detail($conn) {
    $row = User::getUser($conn, $_POST['id']);
    require_once "../views/user/detail.php";
}

function save($conn) {
    $user = createUser($conn);

    if (!$user -> find()) {
        if ($user -> comparePassword($_POST['pass_conf'])) {
            if ($user -> save()) {
                sweetMessage('Guardado correctamente',
                    'Se ha guardado el usuario con éxito.',
                    'success',
                    'all');
            } else
                message('No se ha podido guardar el usuario.', 'alert alert-danger');
        } else
            message('Las contraseñas no coinciden.', 'alert alert-danger');
    } else
        message('El nombre de usuario ingresado ya existe.', 'alert alert-danger');
}

function update($conn) {
    $user = createUser($conn);

    if ($user ->comparePassword($_POST['pass_conf'])) {
        if ($user -> update($_POST['id'])) {
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
    } else
        message('Las contraseñas no coinciden.','alert alert-danger');
}

function delete($conn) {
    echo User::delete($conn, $_POST['id']);
}

function createUser($conn) {
    return new User($conn, $_POST['user'], $_POST['nombre'], $_POST['apaterno'], $_POST['amaterno'], $_POST['pass'], 'normal');
}