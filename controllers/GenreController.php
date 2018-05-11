<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:09 PM
 */

require_once "../database/conf.php";

$function = $_POST['func'];
$function($conn);

function table($conn) {
    $sql = "SELECT * FROM generos WHERE nombre LIKE '%{$_POST['search']}%'";
    $res = $conn -> query($sql);
    $count = $res -> rowCount();
    require_once "../views/genre/row.php";
}

function save($conn) {
    $sql = "INSERT INTO generos (nombre) VALUES ('{$_POST['nombre']}')";
    if ($conn -> exec($sql)) {
        sweetMessage('Guardado correctamente',
            'Se ha guardado el género con éxito.',
            'success',
            'all');
    } else
        message('No se ha podido guardar el género', 'alert alert-danger');
}

function update($conn) {
    $sql = "UPDATE generos SET nombre = '{$_POST['nombre']}' WHERE idgeneros = {$_POST['id']}";
    if ($conn -> exec($sql)) {
        sweetMessage('Actualizado correctamente',
            'Se ha actualizado el género con éxito.',
            'success',
            'all');
    } else
        message('No se ha podido actualizar el género o no se realizaron cambios.', 'alert alert-danger');
}

function delete($conn) {
    $sql = "DELETE FROM generos WHERE idgeneros = {$_POST['id']}";
    echo $conn -> exec($sql);
}