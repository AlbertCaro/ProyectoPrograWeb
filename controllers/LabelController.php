<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:10 PM
 */

require_once "conf.php";

$function = $_POST['func'];
$function($conn);

function table($conn) {
    $sql = "SELECT * FROM disqueras WHERE nombre LIKE '%{$_POST['search']}%' OR fundacion LIKE '%{$_POST['search']}%'
              OR pais LIKE '{$_POST['search']}'";
    $res = $conn -> query($sql);
    $count = $res -> rowCount();

    echo $count;

    if ($count != 0) {
        $rows = $res -> fetchAll();
        foreach ($rows as $row) {
            echo "
        <tr id='row_{$row['iddisqueras']}'>
            <td>
                {$row['nombre']}
            </td>
            <td>
                {$row['fundacion']}
            </td>
            <td>
                {$row['pais']}
            </td>
            <td>
                <a class='btn btn-default' href='../label/{$row['iddisqueras']}'>Editar</a>
                <a class='btn btn-danger'
                onclick='confirmDelete(\"{$row['nombre']}\", \"{$row['iddisqueras']}\", \"disquera\")'>Eliminar</a>
            </td>
        </tr>";
        }
    } else
        echo "<tr><td colspan='2'>No se obtuvieron resultados.</td></tr>";
}

function save($conn) {
    $sql = "INSERT INTO disqueras (nombre, fundacion, pais) VALUES ('{$_POST['nombre']}', '{$_POST['fundacion']}', '{$_POST['pais']}')";
    if ($conn -> exec($sql)) {
        sweetMessage('Guardado correctamente',
            'Se ha guardado la disquera con éxito.',
            'success',
            'all');
    } else
        message('No se ha podido guardar la disquera', 'alert alert-danger');
}

function update($conn) {
    $sql = "UPDATE disqueras SET nombre = '{$_POST['nombre']}', fundacion = '{$_POST['fundacion']}', pais = '{$_POST['pais']}' WHERE iddisqueras = {$_POST['id']}";
    if ($conn -> exec($sql)) {
        sweetMessage('Actualizado correctamente',
            'Se ha actualizado la disquera con éxito.',
            'success',
            'all');
    } else
        message('No se ha podido actualizar la disquera o no se realizaron cambios.', 'alert alert-danger');
}

function delete($conn) {
    $sql = "DELETE FROM disqueras WHERE iddisqueras = {$_POST['id']}";
    echo $conn -> exec($sql);
}