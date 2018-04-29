<?php

require_once "../../interactors/conf.php";

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
            <form method="post" id="form" onsubmit="">
                <div class="row uniform 50%">
                    <div class="6u 12u$(xsmall)">
                        <input type="text" name="nombre" id="nombre" value="<?php if ($_GET['id'] !== "") echo $rows['nombre'] ?>"
                               placeholder="Nombre" required/>
                        <?php if($_GET['id'] !== "") echo "<input type='hidden' name='id' id='id' value='{$rows['idartistas']}'>" ?>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <input type="text" name="pais" id="pais" value="<?php if ($_GET['id'] !== "") echo $rows['pais'] ?>"
                               placeholder="País" required/>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <input type="text" name="debut" id="debut" value="<?php if ($_GET['id'] !== "") echo $rows['debut'] ?>"
                               onclick="setYearSelect('debut')" placeholder="Año de debut" required/>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <input type="text" name="retiro" id="retiro" value="<?php if ($_GET['id'] !== "") echo $rows['retiro'] ?>"
                               onclick="setYearSelect('retiro')" placeholder="Año de retiro" />
                    </div>
                    <div class="12u$">
                        <textarea name="descripcion" id="descripcion" placeholder="Descripción..." rows="5" required><?php
                            if ($_GET['id'] !== "") echo $rows['descripcion'] ?></textarea>
                    </div>
                    <div id="response">

                    </div>
                    <div class="12u$">
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
        order: 'desc'
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
                "descripcion" : $('#descripcion').val()
            }, '<?php
                if ($_GET['id'] !== "")
                    echo "../interactors/artist/update.php";
                else
                    echo "../interactors/artist/save.php"?>');
        }
    });
</script>
<?php include_once "../elements/footer.php"; ?>
