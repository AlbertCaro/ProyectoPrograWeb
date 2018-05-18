<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 11/05/2018
 * Time: 05:34 PM
 */
require_once "../models/Favorite.php";

if ($count != 0) {
    $rows = $res -> fetchAll();
    foreach ($rows as $row) {
        $favorite = new Favorite($row['idcanciones'], $_SESSION['id']);
        echo "
        <tr id='row_{$row['idcanciones']}'>
            <td>
                <a href='#' id='detail_button_{$row['idcanciones']}' onclick='showDetail(\"{$row['idcanciones']}\", \"#detail_{$row['idcanciones']}\", event)'>
                    <img id='image_{$row['idcanciones']}' src='../assets/img/more.png' width='15px'>
                </a>
            </td>
            <td>{$row['cancion']}</td>
            <td>{$row['artista']}</td>
            <td>{$row['album']}</td>
            <td><a href='#' id='link_{$row['idcanciones']}'
             onclick='";
        if ($favorite -> isFavorite())
            echo "un";
        echo "setFavorite({$row['idcanciones']}, event)'>
             <img width='24' id='image_fav_{$row['idcanciones']}' style='vertical-align: middle' src='../assets/img/favorite";
        if ($favorite -> isFavorite())
            echo "_checked";
        echo ".png' /></a></td>
        </tr>
        <tr id='detail_{$row['idcanciones']}'>
        </tr>";
    }
} else
    echo "<tr><td colspan='3'>No se obtuvieron resultados.</td></tr>";