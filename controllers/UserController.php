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
$function();

function table() {
    $res = User::search($_POST['search']);
    $count = $res -> rowCount();
    echo $count;
    require_once "../views/user/row.php";
}

function detail() {
    $row = User::get($_POST['id']);
    require_once "../views/user/detail.php";
}

function save() {
    $user = createUser();

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

function update() {
    $user = createUser();

    if ($user ->comparePassword($_POST['pass_conf'])) {
        if ($user -> update($_POST['id'])) {
            sweetMessage('Actualizado correctamente',
                'Se ha actualizado el artista con éxito.',
                'success',
                'all');
        } else
            message('No se ha podido actualizar el usuario o no se han realizado cambios.', 'alert alert-danger');
    } else
        message('Las contraseñas no coinciden.','alert alert-danger');
}

function delete() {
    echo User::delete($_POST['id']);
}

function createUser() {
    return new User($_POST['user'], $_POST['nombre'], $_POST['apaterno'], $_POST['amaterno'], $_POST['pass'], 'normal');
}