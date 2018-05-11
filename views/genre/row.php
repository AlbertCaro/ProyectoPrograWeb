<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 10/05/2018
 * Time: 11:29 AM
 */
session_start();
if ($count != 0) {
    $rows = $res -> fetchAll();
    foreach ($rows as $row) {
        echo "
        <tr id='row_{$row['idgeneros']}'>
            <td colspan='7'>
                {$row['nombre']}
            </td>";
        if ($_SESSION['role'] === "admin"){
            echo "
            <td>
                <a class='btn btn-default' href='../genre/{$row['idgeneros']}'>Editar</a>
                <a class='btn btn-danger'
                onclick='confirmDelete(\"{$row['nombre']}\", \"{$row['idgeneros']}\", \"género\")'>Eliminar</a>
            </td>";
        }
        echo "
        </tr>";
    }
} else
    echo "<tr><td colspan='2'>No se obtuvieron resultados.</td></tr>";