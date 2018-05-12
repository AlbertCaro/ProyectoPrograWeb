<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:09 PM
 */

require_once "../models/Utilities.php";
require_once "../models/Genre.php";

$function = $_POST['func'];
$function();

function table() {
    $res = Genre::search($_POST['search']);
    $count = $res -> rowCount();
    require_once "../views/genre/row.php";
}

function save() {
    $genre = createGenre();

    if ($genre -> save()) {
        Utilities::sweetMessage('Guardado correctamente',
            'Se ha guardado el género con éxito.',
            'success',
            'all');
    } else
        Utilities::message('No se ha podido guardar el género', 'alert alert-danger');
}

function update() {
    $genre = createGenre();

    if ($genre -> update($_POST['id'])) {
        Utilities::sweetMessage('Actualizado correctamente',
            'Se ha actualizado el género con éxito.',
            'success',
            'all');
    } else
        Utilities::message('No se ha podido actualizar el género o no se realizaron cambios.', 'alert alert-danger');
}

function delete() {
    echo Genre::delete($_POST['id']);
}

function createGenre() {
    return new Genre($_POST['nombre']);
}