<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:07 PM
 */

require_once "conf.php";

$function = $_POST['func'];
$function($conn);

function table($conn) {
    $sql = "SELECT albumes.*, a.nombre, d.nombre FROM albumes 
              INNER JOIN disqueras d ON albumes.iddisqueras = d.iddisqueras 
              INNER JOIN artistas a ON albumes.idartistas = a.idartistas 
              WHERE 
              titulo LIKE '%{$_POST['search']}%' OR
              tipo LIKE '%{$_POST['search']}%' OR
              publicacion LIKE '%{$_POST['search']}%' OR 
              a.nombre LIKE '%{$_POST['search']}%' OR 
              d.nombre LIKE '%{$_POST['search']}%'";
    $res = $conn -> query($sql);
    $count = $res -> rowCount();

    echo $count;

    if ($count != 0) {
        $rows = $res -> fetchAll();
        foreach ($rows as $row) {
            echo "
        <tr id='row_{$row['idartistas']}'>
            <td>
                <a href='#' id='detail_button_{$row['idalbumes']}' onclick='showDetail(\"{$row['idalbumes']}\", \"#detail_{$row['idalbumes']}\", event, \"artist\")'>
                    <img id='image_{$row['idartistas']}' src='../assets/img/more.png' width='15px'>
                </a>
            </td>
            <td>{$row['titulo']}</td>
            <td>".deformatDate($row['publicacion'])."</td>
        </tr>
        <tr id='detail_{$row['idartistas']}'>
        </tr>";
        }
    } else
        echo "<tr><td colspan='3'>No se obtuvieron resultados.</td></tr>";
}

function detail($conn) {
    session_start();

    $sql = "SELECT * FROM artistas WHERE idartistas = {$_POST['id']}";
    $res = $conn -> query($sql);
    $row = ($res -> fetchAll())[0];

    if ($row['retiro'] === null)
        $row['retiro'] = "No se ha retirado.";

    echo "
<td colspan='4'>
    <section>
		<h4>Información del artista</h4>
		<div class=\"row\">
			<div class=\"6u 12u$(xsmall)\">
				<div class='12u$'>
					<span><strong>Nombre:</strong> {$row['nombre']}</span>
				</div>
				<div class='12u$'>
					<span><strong>Pais:</strong> {$row['pais']}</span>
				</div>
				<div class='12u$'>
					<span><strong>Debut:</strong> {$row['debut']}</span>
				</div>
				<div class='12u$'>
					<span><strong>Retiro:</strong> {$row['retiro']}</span>
				</div>
			</div>
			<div class=\"6u$ 12u$(xsmall)\">
				<div class='12u$'>
					<span><strong>Descripción:</strong> ".$row['descripcion']."</span>
				</div>
				</div><br/>
			</div>
		</div><br/>";

    if ($_SESSION['role'] == "admin") {
        echo "
		<div align='right'>
            <a class='btn btn-default' href='../artist/{$row['idartistas']}'>Editar</a>
            <a class='btn btn-danger' onclick='confirmDelete(\"{$row['nombre']}\", \"{$row['idartistas']}\", \"artista\")'>Eliminar</a>
		</div>";
    }

    echo "
	</section>
</td>";
}

function save($conn) {
    $date = $_POST['publicacion'];
    $date = str_replace('/', '-', $date);
    $newDate = date('Y-m-d', strtotime($date));
    echo $newDate;
}

function update($conn) {
    if ($_POST['retiro'] == "")
        $retiro = "retiro=null";
    else
        $retiro = "retiro={$_POST['retiro']}";

    $sql = "UPDATE artistas SET
    nombre='{$_POST['nombre']}',
    pais='{$_POST['pais']}', 
    debut='{$_POST['debut']}', 
    $retiro, 
    descripcion='{$_POST['descripcion']}' WHERE idartistas={$_POST['idartistas']}";

    if ($conn -> exec($sql)) {
        sweetMessage('Actualizado correctamente',
            'Se ha actualizado el artista con éxito.',
            'success',
            'all');
    } else {
        sweetMessage('No se ha actualizado',
            'Ah ocurrido un error o no se han hecho cambios.',
            'error',
            'all');
    }
}

function delete($conn) {
    $sql = "DELETE FROM artistas WHERE idartistas = {$_POST['id']}";
    echo $conn -> exec($sql);
}