<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:07 PM
 */

require_once "../database/conf.php";
require_once "../models/Album.php";

$function = $_POST['func'];
$function();

function table() {
    $res = Album::search($_POST['search']);
    $count = $res -> rowCount();
    require_once "../views/album/row.php";
}

function detail() {
    $row = Album::get($_POST['id']);
    require_once "../views/album/detail.php";
}

function save() {
    $album = createAlbum();

    if ($album->save()) {
        sweetMessage('Guardado correctamente',
            'Se ha guardado el artista con éxito.',
            'success',
            'all');
    } else
        message('No se ha podido guardar el album.', 'alert alert-danger');
}

function update() {
    $album = createAlbum();

    if ($album->update($_POST['id'])) {
        sweetMessage('Actualizado correctamente',
            'Se ha actualizado el artista con éxito.',
            'success',
            'all');
    } else
        message('No se ha podido actualizar el album o no ha introducido cambios.', 'alert alert-danger');
}

function delete() {
    echo Album::delete($_POST['id']);
}

function createAlbum() {
    return new Album($_POST['titulo'], $_POST['tipo'], $_POST['publicacion'], $_POST['descripcion'], $_POST['disquera'], $_POST['artista']);
}