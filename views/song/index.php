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
                        <input type="text" name="nombre" id="nombre" value="<?php if ($_GET['id'] !== "") echo $rows['nombre'] ?>"
                               placeholder="Nombre completo" required/>
                        <?php if($_GET['id'] !== "") echo "<input type='hidden' name='id' id='id' value='{$rows['idartistas']}'>" ?>
                    </div>
                    <div class="3u$ 12u$(xsmall)">
                        <label for='pais' style="color: #1C1C1C">Duración:</label>
                        <input type="text" name="duracion" id="duracion" value="<?php if ($_GET['id'] !== "") echo $rows['debut'] ?>"
                               placeholder="Año de debut" required/>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <label for='debut' style="color: #1C1C1C">Año de debut:</label>
                        <select type="text" name="tipo" id="tipo" required>
                            <?php if($_GET['id'] !== "") Album::select($rows['idalbumes']); else Album::select(null); ?>
                        </select>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <label for='retiro' style="color: #1C1C1C">Año de retiro:</label>
                        <input type="text" name="retiro" id="retiro" value="<?php if ($_GET['id'] !== "") echo $rows['retiro'] ?>"
                               onclick="setYearSelect('retiro')" placeholder="Año de retiro" />
                    </div>
                    <div class="12u$">
                        <label for='descripcion' style="color: #1C1C1C">Descripción del artísta:</label>
                        <textarea name="descripcion" id="descripcion" placeholder="Descripción..." rows="5" required><?php
                            if ($_GET['id'] !== "") echo $rows['descripcion'] ?></textarea>
                    </div>
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
        rules: {
            retiro: "number"
        }, messages: {
            nombre: "Debe especificar el nombre",
            pais: "Debe especificar el país",
            debut: {
                required: "Debe especificar el año de debut",
                number: "No puede ingresar letras en un año"
            }, retiro: {
                number: "No puede ingresar letras en un año"
            }, descripcion: "Debe añadir una descripción del artista"
        }, submitHandler: function () {
            sendData({
                <?php if ($_GET['id'] !== '') echo '"id" : $(\'#id\').val(),'?>
                "nombre" : $('#nombre').val(),
                "pais" : $('#pais').val(),
                "debut" : $('#debut').val(),
                "retiro" : $('#retiro').val(),
                "descripcion" : $('#descripcion').val(),
                "func" : '<?php if ($_GET['id'] !== "") echo "update"; else echo "save"?>'
            }, 'controller/');
        }, invalidHandler: function () {
            emptyForm()
        }
    });
</script>
<?php include_once "../layout/footer.php"; ?>

