<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:07 PM
 */

require_once "conf.php";
require_once "../models/Album.php";

$function = $_POST['func'];
$function($conn);

function table($conn) {
    $res = Album::searchAlbum($conn, $_POST['search']);
    $count = $res -> rowCount();

    echo $count;

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
}

function detail($conn) {
    session_start();

    $row = Album::getAlbum($conn, $_POST['id']);

    echo "
<td colspan='4'>
    <section>
		<h4>Información del artista</h4>
		<div class=\"row\">
			<div class=\"6u 12u$(xsmall)\">
				<div class='12u$'>
					<span><strong>Título:</strong> {$row['titulo']}</span>
				</div>
				<div class='12u$'>
					<span><strong>Tipo:</strong> {$row['tipo']}</span>
				</div>
				<div class='12u$'>
					<span><strong>Publicación:</strong> ".deformatDate($row['publicacion'])."</span>
				</div>
				<div class='12u$'>
					<span><strong>Artista:</strong> {$row['artista']}</span>
				</div>
				<div class='12u$'>
					<span><strong>Disquera:</strong> {$row['disquera']}</span>
				</div>
			</div>
			<div class=\"6u$ 12u$(xsmall)\">
				<div class='12u$'>
					<span><strong>Descripción:</strong> ".$row['descripcion']."</span>
				</div>
				</div>
			</div>
		</div>";

    if ($_SESSION['role'] == "admin") {
        echo "
		<div align='right'>
            <a class='btn btn-default' href='../album/{$row['idalbumes']}'>Editar</a>
            <a class='btn btn-danger' onclick='confirmDelete(\"{$row['titulo']}\", \"{$row['idalbumes']}\", \"album\")'>Eliminar</a>
		</div>";
    }

    echo "
	</section>
</td>";
}

function save($conn) {
    $album = createAlbum($conn);

    if ($album->save()) {
        sweetMessage('Guardado correctamente',
            'Se ha guardado el artista con éxito.',
            'success',
            'all');
    } else {
        message('No se ha podido guardar el artista o no se realizaron cambios.', 'alert alert-danger');
    }
}

function update($conn) {
    $album = createAlbum($conn);

    if ($album->update($_POST['id'])) {
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
    echo Album::delete($conn, $_POST['id']);
}

function createAlbum($conn) {
    return new Album($conn, $_POST['titulo'], $_POST['tipo'], $_POST['publicacion'], $_POST['descripcion'], $_POST['disquera'], $_POST['artista']);
}