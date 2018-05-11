<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:07 PM
 */

require_once "../database/conf.php";
require_once "../models/Author.php";

$function = $_POST['func'];
$function($conn);

function table($conn) {
    $res = Author::searchAuthor($conn, $_POST['search']);
    $count = $res -> rowCount();
    require_once '../views/author/row.php';
}

function save($conn) {
    $author = createAuthor($conn);

    if ($author->save()) {
        sweetMessage('Guardado correctamente',
            'Se ha guardado el autor con éxito.',
            'success',
            'all');
    } else
        message('No se ha podido guardar el autor o no se realizaron cambios.', 'alert alert-danger');
}

function update($conn) {
    $author = createAuthor($conn);

    if ($author->update($_POST['id'])) {
        sweetMessage('Guardado correctamente',
            'Se ha actualizado el autor con éxito.',
            'success',
            'all');
    } else
        message('No se ha podido actualizar el autor o no se realizaron cambios.', 'alert alert-danger');
}

function delete($conn) {
    echo Author::delete($conn, $_POST['id']);
}

function createAuthor($conn) {
    return new Author($conn, $_POST['nombre'], $_POST['apaterno'], $_POST['amaterno']);
}