<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 11/05/2018
 * Time: 05:30 PM
 */

session_start();
?>
<td colspan='4'>
    <section>
        <h4>Información del artista</h4>
        <div class="row">
            <div class="6u 12u$(xsmall)">
                <div class='12u$'>
                    <span><strong>Título:</strong> <?php echo $song['titulo'] ?></span>
                </div>
                <div class='12u$'>
                    <span><strong>Artista:</strong> <?php echo $song['artista']; ?></span>
                </div>
                <div class='12u$'>
                    <span><strong>Album:</strong> <?php echo $song['album']; ?></span>
                </div>
                <div class='12u$'>
                    <span><strong>Género:</strong> <?php echo $song['genero']; ?></span>
                </div>
            </div>
            <div class="6u$ 12u$(xsmall)">
                <div class='12u$'>
                    <span><strong>Duración:</strong> <?php echo $song['duracion']; ?></span>
                </div>
                <div class='12u$'>
                    <span><strong>Autor(es):</strong> <?php echo Song::getAuthors($song['idcanciones'], true); ?></span>
                </div>
            </div>

            <?php
            if ($_SESSION['role'] == "admin" && $show_buttons) {
                echo "
            <div align='right' class='12u$'>
                <a class='btn btn-default' href='../song/{$song['idcanciones']}'>Editar</a>
                <a class='btn btn-danger' onclick='confirmDelete(\"{$song['titulo']}\", \"{$song['idcanciones']}\", \"canción\")'>Eliminar</a>
            </div>";
            }
            ?>
    </section>
</td>