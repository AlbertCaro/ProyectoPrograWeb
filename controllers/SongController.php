<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:10 PM
 */

require_once "../models/Utilities.php";
require_once "../models/Author.php";
require_once "../models/Song.php";
require_once "../models/Favorite.php";

$function = $_POST['func'];
$function();

function table() {
    session_start();
    $res = Song::search($_POST['search']);
    $count = $res -> rowCount();
    require_once "../views/song/row.php";
}

function detail() {
    $song = Song::get($_POST['id']);
    $show_buttons = true;
    require_once "../views/song/detail.php";
}

function save() {
    $song = createSong();
    $continue = true;
    if ($_POST['duracion'] !== "0") {
        if ($song -> save()) {
            foreach ($_POST['autores'] as $autor) {
                if (!$song -> linkAuthors($autor)) {
                    $continue = false;
                    Utilities::message('No se ha podido relacionar el autor: '.$autor, 'alert alert-danger');
                }
            }
            if ($continue) {
                Utilities::sweetMessage('Guardado correctamente',
                    'Se ha guardado la canción con éxito.',
                    'success',
                    'all');
            }
        } else
            Utilities::message('No se ha podido guardar la canción', 'alert alert-danger');
    } else
        Utilities::message('Debe especificar una duración.', 'alert alert-danger');
}

function update() {
    $song = createSong();
    $continue = true;

    if ($_POST['duracion'] !== "0") {
        if ($song -> update($_POST['id']) || $_POST['autores-cambio'] !== "") {
            if (Song::unlinkAuthors($_POST['id'])) {
                $song->setId($_POST['id']);
                foreach ($_POST['autores'] as $autor) {
                    if ($autor === "")
                        continue;
                    if (!$song -> linkAuthors($autor)) {
                        $continue = false;
                        Utilities::message('No se ha podido relacionar el autor: '.$autor, 'alert alert-danger');
                    }
                }
                if ($continue) {
                    Utilities::sweetMessage('Actualizada correctamente',
                        'Se ha actualizado la canción con éxito.',
                        'success',
                        'all');
                }
            } else
                Utilities::message('No se ha podido eliminar las relaciones de autor', 'alert alert-danger');
        } else
            Utilities::message('No se ha podido guardar la canción o no se han realizado cambios.', 'alert alert-danger');
    } else
        Utilities::message('Debe especificar una duración.', 'alert alert-danger');
}

function delete() {
    if (Favorite::deleteBySongId($_POST['id'])) {
        if (Song::unlinkAuthors($_POST['id']))
            echo Song::delete($_POST['id']);
        else {
            echo "false2";
        }
    } else {
        echo "false1";
    }
}

function autorInput() {
    Author::select(null, $_POST['div_id'], $_POST['default']);
}

function createSong() {
    return new Song($_POST['nombre'], $_POST['duracion'], $_POST['genero'], $_POST['album']);
}

function setFavorite() {
    session_start();
    $favorite = new Favorite($_POST['fav'], $_SESSION['id']);

    if ($favorite -> save()) {
        echo "setted";
    } else {
        echo "failed";
    }
}

function unsetFavorite() {
    session_start();
    $favorite = new Favorite($_POST['fav'], $_SESSION['id']);

    if ($favorite -> delete()) {
        echo "unsetted";
    } else {
        echo "failed";
    }
}