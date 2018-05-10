<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 10/05/2018
 * Time: 11:07 AM
 */

if ($count != 0) {
    $rows = $res -> fetchAll();
    foreach ($rows as $row) {
        echo "
        <tr id='row_{$row['idartistas']}'>
            <td>
                <a href='#' id='detail_button_{$row['idartistas']}' onclick='showDetail(\"{$row['idartistas']}\", \"#detail_{$row['idartistas']}\", event, \"artist\")'>
                    <img id='image_{$row['idartistas']}' src='../assets/img/more.png' width='15px'>
                </a>
            </td>
            <td>{$row['nombre']}</td>
            <td>{$row['pais']}</td>
            <td>{$row['debut']}</td>
        </tr>
        <tr id='detail_{$row['idartistas']}'>
        </tr>";
    }
} else
    echo "<tr><td colspan='4'>No se obtuvieron resultados.</td></tr>";

