<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 10/05/2018
 * Time: 12:55 PM
 */
session_start();
if ($count != 0) {
    $rows = $res -> fetchAll();
    foreach ($rows as $row) {
        echo "
        <tr id='row_{$row['idautores']}'>
            <td>
                {$row['nombre']} {$row['apaterno']} {$row['amaterno']}
            </td>";

        if ($_SESSION['role'] == "admin") {
            echo "
            <td>
                <a class='btn btn-default' href='../author/{$row['idautores']}'>Editar</a>
                <a class='btn btn-danger'
                onclick='confirmDelete(\"{$row['nombre']} {$row['apaterno']} {$row['amaterno']}\", \"{$row['idautores']}\", \"autor\")'>Eliminar</a>
            </td>";
        }
        echo "</tr>";
    }
} else
    echo "<tr><td colspan='2'>No se obtuvieron resultados.</td></tr>";