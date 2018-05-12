<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:05 AM
 */

require_once "../database/conf.php";
require_once "../models/Artist.php";

if (isset($_GET['func']))
    $function = $_GET['func'];
else
    $function = $_POST['func'];
$function();

function table() {
    $res = Artist::search($_POST['search']);
    $count = $res -> rowCount();
    require_once "../views/artist/row.php";
}

function detail() {
    $row = Artist::get($_POST['id']);

    if ($row['retiro'] === null)
        $row['retiro'] = "No se ha retirado.";

    require_once "../views/artist/detail.php";
}

function save() {
    $artist = new Artist($_POST['nombre'], $_POST['descripcion'], $_POST['pais'], $_POST['debut'], $_POST['retiro']);
    if ($artist -> save()) {
        sweetMessage('Guardado correctamente',
            'Se ha guardado el artista con éxito.',
            'success',
            'all');
    } else
        message('No se ha podido guardar el artista.', 'alert alert-danger');
}

function update() {
    $artist = new Artist($_POST['nombre'], $_POST['descripcion'], $_POST['pais'], $_POST['debut'], $_POST['retiro']);
    if ($artist->update($_POST['id'])) {
        sweetMessage('Actualizado correctamente',
            'Se ha actualizado el artista con éxito.',
            'success',
            'all');
    } else
        message('No se ha podido artista el artista o no se realizaron cambios.', 'alert alert-danger');
}

function delete() {
    echo Artist::delete($_POST['id']);
}

function createArtist() {
    return new Artist($_POST['nombre'], $_POST['descripcion'], $_POST['pais'], $_POST['debut'], $_POST['retiro']);
}