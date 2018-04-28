<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 25/04/2018
 * Time: 10:18 AM
 */
require_once "../../conf.php";

$sql = "SELECT idusuarios, usuario, CONCAT(nombre, ' ', apaterno, ' ', amaterno) as nombreCompleto FROM
usuarios WHERE usuario LIKE '%{$_POST['search']}%' OR CONCAT(nombre, ' ', apaterno, ' ', amaterno) LIKE '%{$_POST['search']}%'";
$res = $conn -> query($sql);
$count = $res -> rowCount();

echo $count;

if ($count != 0) {
    $rows = $res -> fetchAll();
    foreach ($rows as $row) {
        echo "
        <tr>
            <td>
                <a href='#' id='detail_button_{$row['idusuarios']}' onclick='showDetail(\"{$row['idusuarios']}\", \"#detail_{$row['idusuarios']}\", event)'>
                    <img id='image_{$row['idusuarios']}' src='../images/more.png' width='15px'>
                </a>
            </td>
            <td>{$row['usuario']}</td>
            <td>{$row['nombreCompleto']}</td>
        </tr>
        <tr id='detail_{$row['idusuarios']}'>
        </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No se obtuvieron resultados.</td></tr>";
}?>

