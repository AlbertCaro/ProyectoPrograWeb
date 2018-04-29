<?php

require_once "../../controllers/conf.php";

$title = "Agregar artista";

include_once "../elements/session_valid.php";
include_once "../elements/session_roles.php";

if ($_GET['id'] !== "") {
    $sql = "SELECT * FROM artistas WHERE idartistas = {$_GET['id']}";
    $res = $conn -> query($sql);
    $rows = ($res -> fetchAll())[0];
    $title = "Editar artista";
}

include_once "../elements/navbar.php";

?>
<!-- Main -->
<section id="main" >
    <div class="inner">
        <header class="major special">
            <h1><?php echo $title ?></h1>
        </header>
        <section>
            <h3>Información del artista</h3>
            <form method="post" id="form">
                <div class="row uniform 50%">
                    <div class="6u 12u$(xsmall)">
                        <label for='nombre'>Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php if ($_GET['id'] !== "") echo $rows['nombre'] ?>"
                               placeholder="Nombre completo" required/>
                        <?php if($_GET['id'] !== "") echo "<input type='hidden' name='id' id='id' value='{$rows['idartistas']}'>" ?>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <label for='pais'>País:</label>
                        <select id="pais" name="pais" class="selectpicker countrypicker" data-flag="true"
                                data-live-search="true" <?php if($_GET['id'] !== "") echo "data-default='{$rows['pais']}'" ?> required>
                        </select>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <label for='debut'>Año de debut:</label>
                        <input type="text" name="debut" id="debut" value="<?php if ($_GET['id'] !== "") echo $rows['debut'] ?>"
                               onclick="setYearSelect('debut')" placeholder="Año de debut" required/>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <label for='retiro'>Año de retiro:</label>
                        <input type="text" name="retiro" id="retiro" value="<?php if ($_GET['id'] !== "") echo $rows['retiro'] ?>"
                               onclick="setYearSelect('retiro')" placeholder="Año de retiro" />
                    </div>
                    <div class="12u$">
                        <label for='descripcion'>Descripción del artísta:</label>
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
    $("#debut").yearselect({
        order: 'desc',
        start: 1900
    });

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
                <?php if ($_GET['id'] !== '') echo '"idartistas" : $(\'#id\').val(),'?>
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
    <?php include_once "../elements/footer.php"; ?>

