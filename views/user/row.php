<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 10/05/2018
 * Time: 09:12 AM
 */
session_start();
if ($count != 0) {
    $rows = $res -> fetchAll();
    foreach ($rows as $row) {
        echo "
        <tr id='row_{$row['idusuarios']}'>
            <td>
                <a href='#' id='detail_button_{$row['idusuarios']}' onclick='showDetail(\"{$row['idusuarios']}\", \"#detail_{$row['idusuarios']}\", event)'>
                    <img id='image_{$row['idusuarios']}' src='../assets/img/more.png' width='15px'>
                </a>
            </td>
            <td>{$row['usuario']}</td>
            <td>{$row['nombreCompleto']}</td>
        </tr>
        <tr id='detail_{$row['idusuarios']}'>
        </tr>";
    }
} else
    echo "<tr><td colspan='4'>No se obtuvieron resultados.</td></tr>";