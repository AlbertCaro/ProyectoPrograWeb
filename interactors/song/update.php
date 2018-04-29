<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 25/04/2018
 * Time: 11:47 PM
 */

require_once "../conf.php";

if ($_POST['retiro'] == "")
    $retiro = "retiro=null";
else
    $retiro = "retiro={$_POST['retiro']}";

$sql = "UPDATE artistas SET
    nombre='{$_POST['nombre']}',
    pais='{$_POST['pais']}', 
    debut='{$_POST['debut']}', 
    $retiro, 
    descripcion='{$_POST['descripcion']}' WHERE idartistas={$_POST['idartistas']}";

if ($conn -> exec($sql)) {
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