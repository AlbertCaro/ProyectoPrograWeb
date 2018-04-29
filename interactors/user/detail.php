<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 26/04/2018
 * Time: 04:16 PM
 */

require_once "../conf.php";
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
