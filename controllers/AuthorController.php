<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:07 PM
 */

require_once "../models/Utilities.php";
require_once "../models/Author.php";

$function = $_POST['func'];
$function();

function table() {
    $res = Author::search($_POST['search']);
    $count = $res -> rowCount();
    require_once '../views/author/row.php';
}

function save() {
    $author = createAuthor();
    if ($author->save()) {
        Utilities::sweetMessage('Guardado correctamente',
            'Se ha guardado el autor con éxito.',
            'success',
            'all');
    } else
        Utilities::message('No se ha podido guardar el autor.', 'alert alert-danger');
}

function update() {
    $author = createAuthor();
    if ($author->update($_POST['id'])) {
        Utilities::sweetMessage('Actualizado correctamente',
            'Se ha actualizado el autor con éxito.',
            'success',
            'all');
    } else
        Utilities::message('No se ha podido actualizar el autor o no se realizaron cambios.', 'alert alert-danger');
}

function delete() {
    echo Author::delete($_POST['id']);
}

function createAuthor() {
    return new Author($_POST['nombre'], $_POST['apaterno'], $_POST['amaterno']);
}

