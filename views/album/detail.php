<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 10/05/2018
 * Time: 11:14 AM
 */
session_start();
?>
<td colspan='4'>
    <section>
        <h4>Información del artista</h4>
        <div class="row">
            <div class="6u 12u$(xsmall)">
            <div class='12u$'>
                <span><strong>Título:</strong> <?php echo $row['titulo']; ?></span>
            </div>
            <div class='12u$'>
                <span><strong>Tipo:</strong> <?php echo $row['tipo']; ?></span>
            </div>
            <div class='12u$'>
                <span><strong>Publicación:</strong> <?php echo Utilities::deformatDate($row['publicacion']); ?></span>
            </div>
            <div class='12u$'>
                <span><strong>Artista:</strong> <?php echo $row['artista']; ?></span>
            </div>
            <div class='12u$'>
                <span><strong>Disquera:</strong> <?php echo $row['disquera']; ?></span>
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
            <div align='right' class='12u$'>
                <a class='btn btn-default' href='../album/{$row['idalbumes']}'>Editar</a>
                <a class='btn btn-danger' onclick='confirmDelete(\"{$row['titulo']}\", \"{$row['idalbumes']}\", \"album\")'>Eliminar</a>
            </div>";
            }
        ?>
    </section>
</td>
