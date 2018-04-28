<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 25/04/2018
 * Time: 05:53 PM
 */

require_once "../../conf.php";

$sql = "INSERT INTO artistas (nombre, descripcion, pais, debut, retiro) VALUES
 ('{$_POST['nombre']}', '{$_POST['descripcion']}', '{$_POST['pais']}', '{$_POST['debut']}', '{$_POST['retiro']}')";

if ($conn -> exec($sql)) {
    sweetMessage('Guardado correctamente',
        'Se ha guardado el artista con éxito.',
        'success',
        'all');
} else {
    message('No se ha podido guardar el artista.', 'alert alert-danger');
}