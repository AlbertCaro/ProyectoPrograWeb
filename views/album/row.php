<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 10/05/2018
 * Time: 11:19 AM
 */
session_start();
if ($count != 0) {
    $rows = $res -> fetchAll();
    foreach ($rows as $row) {
        echo "
        <tr id='row_{$row['idalbumes']}'>
            <td>
                <a href='#' id='detail_button_{$row['idalbumes']}' onclick='showDetail(\"{$row['idalbumes']}\", \"#detail_{$row['idalbumes']}\", event, \"artist\")'>
                    <img id='image_{$row['idalbumes']}' src='../assets/img/more.png' width='15px'>
                </a>
            </td>
            <td>{$row['titulo']}</td>
            <td>".deformatDate($row['publicacion'])."</td>
        </tr>
        <tr id='detail_{$row['idalbumes']}'>
        </tr>";
    }
} else
    echo "<tr><td colspan='3'>No se obtuvieron resultados.</td></tr>";