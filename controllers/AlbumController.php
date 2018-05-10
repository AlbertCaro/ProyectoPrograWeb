<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:07 PM
 */

require_once "conf.php";
require_once "../models/Album.php";

$function = $_POST['func'];
$function($conn);

function table($conn) {
    $res = Album::searchAlbum($conn, $_POST['search']);
    $count = $res -> rowCount();
    require_once "../views/album/row.php";
}

function detail($conn) {
    session_start();
    $row = Album::getAlbum($conn, $_POST['id']);
    require_once "../views/album/detail.php";
}

function save($conn) {
    $album = createAlbum($conn);

    if ($album->save()) {
        sweetMessage('Guardado correctamente',
            'Se ha guardado el artista con éxito.',
            'success',
            'all');
    } else {
        message('No se ha podido guardar el artista o no se realizaron cambios.', 'alert alert-danger');
    }
}

function update($conn) {
    $album = createAlbum($conn);

    if ($album->update($_POST['id'])) {
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

function delete($conn) {
    echo Album::delete($conn, $_POST['id']);
}

function createAlbum($conn) {
    return new Album($conn, $_POST['titulo'], $_POST['tipo'], $_POST['publicacion'], $_POST['descripcion'], $_POST['disquera'], $_POST['artista']);
}