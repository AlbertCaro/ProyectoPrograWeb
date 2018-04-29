<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:05 AM
 */

require_once "conf.php";

$function = $_POST['func'];
$function($conn);

function table($conn) {
    $sql = "SELECT idusuarios, usuario, CONCAT(nombre, ' ', apaterno, ' ', amaterno) as nombreCompleto FROM
usuarios WHERE usuario LIKE '%{$_POST['search']}%' OR CONCAT(nombre, ' ', apaterno, ' ', amaterno) LIKE '%{$_POST['search']}%'";
    $res = $conn -> query($sql);
    $count = $res -> rowCount();

    echo $count;

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
}

function detail($conn) {
    session_start();

    $sql = "SELECT * FROM usuarios WHERE idusuarios = {$_POST['id']}";
    $res = $conn -> query($sql);
    $row = ($res -> fetchAll())[0];

    echo "
<td colspan='4'>
    <section>
		<h4>Información del artista</h4>
		<div class=\"row\">
			<div class=\"6u 12u$(xsmall)\">
				<div class='12u$'>
					<span><strong>Usuario:</strong> {$row['usuario']}</span>
				</div>
				<div class='12u$'>
					<span><strong>Rol: </strong>"; if ($row['rol'] === "admin") echo "Administrador"; else echo "Normal"; echo"</span>
				</div>
				
			</div>
			<div class=\"6u$ 12u$(xsmall)\">
				<div class='12u$'>
					<span><strong>Nombre(s):</strong> {$row['nombre']}</span>
				</div>
				<div class='12u$'>
					<span><strong>Apellido paterno:</strong> {$row['apaterno']}</span>
				</div>
				<div class='12u$'>
					<span><strong>Apellido materno:</strong> {$row['amaterno']}</span>
				</div>
			</div><br/>
			</div>
		</div><br/>";

    if ($_SESSION['role'] == "admin") {
        echo "
		<div align='right'>
            <a class='btn btn-default' href='../user/{$row['idusuarios']}'>Editar</a>
            <a class='btn btn-danger' onclick='confirmDelete(\"{$row['nombre']}\", \"{$row['idusuarios']}\", \"usuario\", \"user\")'>Eliminar</a>
		</div>";
    }

    echo "
	</section>
</td>";

}

function save($conn) {
    $sql = "SELECT * FROM usuarios WHERE usuario = '{$_POST['user']}'";
    $res = $conn -> query($sql);

    if (!$res -> rowCount()) {
        if ($_POST['pass'] === $_POST['pass_conf']) {
            $sql = "INSERT INTO usuarios (usuario, pass, nombre, apaterno, amaterno, rol) VALUES
 ('{$_POST['user']}', '{$_POST['pass']}', '{$_POST['nombre']}', '{$_POST['apaterno']}', '{$_POST['apaterno']}', 'normal')";

            if ($conn -> exec($sql)) {
                sweetMessage('Guardado correctamente',
                    'Se ha guardado el usuario con éxito.',
                    'success',
                    'all');
            } else {
                message('No se ha podido guardar el usuario.', 'alert alert-danger');
            }
        } else
            message('Las contraseñas no coinciden.', 'alert alert-danger');
    } else
        message('El nombre de usuario ingresado ya existe.', 'alert alert-danger');
}

function update($conn) {
    $continue = true;
    $sql = "UPDATE usuarios SET
  nombre = '{$_POST['nombre']}',
  apaterno = '{$_POST['apaterno']}',
  amaterno = '{$_POST['amaterno']}'";

    if ($_POST['pass'] !== "") {
        if ($_POST['pass'] === $_POST['pass_conf']) {
            $sql .= ", pass = MD5('{$_POST['pass']}')";
        } else {
            $continue = false;
            message('Las contraseñas no coinciden.','alert alert-danger');
        }
    }

    $sql .= " WHERE idusuarios = '{$_POST['id']}'";

    if ($continue) {
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
}

function delete($conn) {
    $sql = "DELETE FROM usuarios WHERE idusuarios = {$_POST['id']}";
    echo $conn -> exec($sql);
}