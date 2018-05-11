<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 10/05/2018
 * Time: 09:07 AM
 */
session_start();
?>
<td colspan='4'>
    <section>
        <h4>Información del usuario</h4>
        <div class="row">
            <div class="6u 12u$(xsmall)">
            <div class='12u$'>
                <span><strong>Usuario:</strong> <?php echo $row['usuario']; ?></span>
            </div>
            <div class='12u$'>
                <span><strong>Rol: </strong> <?php if ($row['rol'] === "admin") echo "Administrador"; else echo "Normal"; ?></span>
            </div>

        </div>
        <div class="6u$ 12u$(xsmall)">
        <div class='12u$'>
            <span><strong>Nombre(s):</strong> <?php echo $row['nombre']; ?></span>
        </div>
        <div class='12u$'>
            <span><strong>Apellido paterno:</strong> <?php echo $row['apaterno']; ?></span>
        </div>
        <div class='12u$'>
            <span><strong>Apellido materno:</strong> <?php echo $row['amaterno']; ?></span>
        </div>

        <?php
        if ($_SESSION['role'] == "admin") {
        echo "
        <div align='right'>
            <a class='btn btn-default' href='../user/{$row['idusuarios']}'>Editar</a>
            <a class='btn btn-danger' onclick='confirmDelete(\"{$row['nombre']}\", \"{$row['idusuarios']}\", \"usuario\")'>Eliminar</a>
        </div>";
        }
        ?>
    </section>
</td>
