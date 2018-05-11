<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 10/05/2018
 * Time: 09:48 AM
 */
session_start();
?>
<td colspan='4'>
    <section>
        <h4>Información del artista</h4>
        <div class="row">
            <div class="6u 12u$(xsmall)">
            <div class='12u$'>
                <span><strong>Nombre:</strong> <?php echo $row['nombre']; ?></span>
            </div>
            <div class='12u$'>
                <span><strong>Pais:</strong> <?php echo $row['pais']; ?></span>
            </div>
            <div class='12u$'>
                <span><strong>Debut:</strong> <?php echo $row['debut']; ?></span>
            </div>
            <div class='12u$'>
                <span><strong>Retiro:</strong> <?php echo $row['retiro']; ?></span>
            </div>
        </div>
        <div class="6u$ 12u$(xsmall)">
        <div class='12u$'>
            <span><strong>Descripción:</strong> <?php echo $row['descripcion']; ?></span>
        </div>
        </div>

        <?php
        if ($_SESSION['role'] == "admin") {
            echo "
            <div align='right'>
                <a class='btn btn-default' href='../artist/{$row['idartistas']}'>Editar</a>
                <a class='btn btn-danger' onclick='confirmDelete(\"{$row['nombre']}\", \"{$row['idartistas']}\", \"artista\")'>Eliminar</a>
            </div>";
        }
        ?>
    </section>
</td>
