<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 26/04/2018
 * Time: 04:16 PM
 */

require_once "../../conf.php";
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
            <a class='btn btn-danger' onclick='confirmDelete(\"{$row['nombre']}\",\"{$row['idartistas']}\")'>Eliminar</a>
		</div>";
}

echo "
	</section>
</td>";
