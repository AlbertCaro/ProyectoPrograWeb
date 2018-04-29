<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 25/04/2018
 * Time: 10:18 AM
 */
require_once "../conf.php";

$sql = "SELECT * FROM artistas WHERE nombre LIKE '%{$_POST['search']}%' OR pais LIKE '%{$_POST['search']}%' OR debut LIKE '%{$_POST['search']}%'";
$res = $conn -> query($sql);
$count = $res -> rowCount();

echo $count;

if ($count != 0) {
    $rows = $res -> fetchAll();
    foreach ($rows as $row) {
        echo "
        <tr>
            <td>
                <a href='#' id='detail_button_{$row['idartistas']}' onclick='showDetail(\"{$row['idartistas']}\", \"#detail_{$row['idartistas']}\", event, \"song\")'>
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
} else {
    echo "<tr><td colspan='4'>No se obtuvieron resultados.</td></tr>";
}?>

