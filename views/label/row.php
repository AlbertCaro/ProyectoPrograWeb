<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 10/05/2018
 * Time: 11:54 AM
 */
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
            </td>";

        if ($_SESSION['role'] == "admin") {
            echo "
            <td>
                <a class='btn btn-default' href='../label/{$row['iddisqueras']}'>Editar</a>
                <a class='btn btn-danger'
                onclick='confirmDelete(\"{$row['nombre']}\", \"{$row['iddisqueras']}\", \"disquera\")'>Eliminar</a>
            </td>";
        }
        echo "</tr>";
    }
} else
    echo "<tr><td colspan='2'>No se obtuvieron resultados.</td></tr>";