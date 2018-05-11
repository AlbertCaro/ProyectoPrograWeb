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
$function($conn);

function table($conn) {
    $res = Artist::searchArtist($conn, $_POST['search']);
    $count = $res -> rowCount();
    require_once "../views/artist/row.php";
}

function detail($conn) {
    $row = Artist::getArtist($conn, $_POST['id']);

    if ($row['retiro'] === null)
        $row['retiro'] = "No se ha retirado.";

    require_once "../views/artist/detail.php";
}

function save($conn) {
    $artist = createArtist($conn);

    if ($artist->save()) {
        sweetMessage('Guardado correctamente',
            'Se ha guardado el artista con éxito.',
            'success',
            'all');
    } else {
        message('No se ha podido guardar el artista o no se realizaron cambios.', 'alert alert-danger');
    }
}

function update($conn) {
    $artist = createArtist($conn);

    if ($artist->update($_POST['id'])) {
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
    echo Artist::delete($conn, $_POST['id']);
}

function createArtist($conn) {
    return new Artist($conn, $_POST['nombre'], $_POST['descripcion'], $_POST['pais'], $_POST['debut'], $_POST['retiro']);
}