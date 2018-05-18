<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 25/04/2018
 * Time: 09:50 AM
 */

require_once "../../models/Utilities.php";
require_once "../../models/Song.php";
require_once "../../models/Album.php";
require_once "../../models/Genre.php";
require_once "../../models/Author.php";

$title = "Agregar canción";

include_once "../layout/session_valid.php";
include_once "../layout/session_roles.php";

if ($_GET['id'] !== "") {
    $rows = Song::get($_GET['id']);
    $title = "Editar canción";
}

include_once "../layout/navbar.php";

?>
<!-- Main -->
<section id="main" >
    <div class="inner">
        <header class="major special">
            <h1><?php echo $title ?></h1>
        </header>
        <section>
            <h3 style="color: #1C1C1C">Información de la canción</h3>
            <form method="post" id="form">
                <div class="row uniform 50%">
                    <div class="9u 12u$(xsmall)">
                        <label for='nombre' style="color: #1C1C1C">Título:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php if ($_GET['id'] !== "") echo $rows['titulo'] ?>"
                               placeholder="Título de la canción" required/>
                        <?php if($_GET['id'] !== "") echo "<input type='hidden' name='id' id='id' value='{$rows['idcanciones']}'>" ?>
                    </div>
                    <div class="3u$ 12u$(xsmall)">
                        <label for='pais' style="color: #1C1C1C">Duración:</label>
                        <input type="text" name="duracion" id="duracion" value="<?php if ($_GET['id'] !== "") echo Utilities::timeToSeconds($rows['duracion']) ?>"
                               placeholder="Año de debut" required/>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <label for='album' style="color: #1C1C1C">Album:</label>
                        <select type="text" name="album" id="album" required>
                            <?php if($_GET['id'] !== "") Album::select($rows['idalbumes']); else Album::select(null); ?>
                        </select>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <label for='genero' style="color: #1C1C1C">Género:</label>
                        <select type="text" name="genero" id="genero" required>
                            <?php if($_GET['id'] !== "") Genre::select($rows['idgeneros']); else Genre::select(null); ?>
                        </select>
                    </div>
                    <div class="12u">
                        <label for='authors' style="color: #1C1C1C">Autores: </label>
                        <div id="authors" class="row uniform">
                            <?php

                            if ($_GET['id'] !== "") {
                                $authors = Song::getAuthors($rows['idcanciones'], false);
                                $default = "true";
                                $count = 0;
                                foreach ($authors as $author) {
                                    Author::select($author['idautores'], $count, $default);
                                    $count++;
                                    if ($default == "true")
                                        $default = "false";
                                }
                            } else
                                Author::select(null, 0, "true");

                            ?>
                        </div>
                    </div>
                    <input type="hidden" id="authors-change" name="authors-change" value="">
                    <div id="response" align="center" class="12u$">

                    </div>
                    <div class="12u$" align="center">
                        <ul class="actions">
                            <li><input type="submit" value="Guardar" class="special" onclick=""/></li>
                        </ul>
                    </div>
                </div>
            </form>
        </section>
    </div>
</section>
<script type="text/javascript">
    $("#duracion").durationPicker();
    $("#form").validate({
        messages: {
            nombre: "Debe especificar el nombre",
            duracion: "Debe especificar la duración",
            album: "Debe especificar el album",
            genero: "Debe especificar un género",
            0 : 'Debe especificar por lo menos un autor'
        }, submitHandler: function () {
            var authors = document.getElementsByName("autores[]");
            var array = [];
            for (var i = 0; i < authors.length; i++) {
                array.push(authors[i].value);
            }
            sendData({
                <?php if ($_GET['id'] !== '') echo '"id" : $(\'#id\').val(),'?>
                "nombre" : $('#nombre').val(),
                "duracion" : $('#duracion').val(),
                "album" : $('#album').val(),
                "genero" : $('#genero').val(),
                "autores" : array,
                "autores-cambio" : $('#authors-change').val(),
                "func" : '<?php if ($_GET['id'] !== "") echo "update"; else echo "save"?>'
            }, 'controller/');
        }, invalidHandler: function () {
            emptyForm()
        }
    });
</script>
<?php include_once "../layout/footer.php"; ?>

