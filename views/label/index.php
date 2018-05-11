<?php

require_once "../../database/conf.php";
require_once "../../models/Label.php";

$title = "Agregar disquera";

include_once "../layout/session_valid.php";
include_once "../layout/session_roles.php";

if ($_GET['id'] !== "") {
    $rows = Label::get($conn, $_GET['id']);
    $title = "Editar disquera";
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
            <h3 style="color: #1c1c1c">Información de la disquera</h3>
            <form method="post" id="form" onsubmit="">
                <div class="row uniform 50%">
                    <div class="12u 12u$(xsmall)">
                        <label for="nombre" style="color: #1c1c1c">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php if ($_GET['id'] !== "") echo $rows['nombre'] ?>"
                               placeholder="Nombre" required/>
                        <?php if($_GET['id'] !== "") echo "<input type='hidden' name='id' id='id' value='{$rows['iddisqueras']}'>" ?>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <label for="fundacion" style="color: #1c1c1c">Año de fundación:</label>
                        <input type="text" name="fundacion" id="fundacion" value="<?php if ($_GET['id'] !== "") echo $rows['fundacion'] ?>" required/>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <label for="pais" style="color: #1c1c1c">País:</label>
                        <select type="text" name="pais" id="pais" data-default="<?php if ($_GET['id'] !== "") echo $rows['pais'] ?>"
                                class="selectpicker countrypicker" required>
                        </select>
                    </div>
                    <div class="12u$" id="response">

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
    $("#fundacion").yearselect({
        order: 'desc',
        start: 1900
    });

    $("#form").validate({
        rules: {
            fundacion: "number"
        }, messages: {
            nombre: "Debe especificar el nombre",
            pais: "Debe especificar el país",
            fundacion: {
                required: "Debe especificar el año de fundación",
                number: "No puede ingresar letras en un año"
            }
        }, submitHandler: function () {
            sendData({
                <?php if ($_GET['id'] !== '') echo '"id" : $(\'#id\').val(),'?>
                "nombre" : $('#nombre').val(),
                "pais" : $('#pais').val(),
                "fundacion" : $('#fundacion').val(),
                "func" : '<?php if ($_GET['id'] !== "") echo "update"; else echo "save"?>'
            }, 'controller/');
        }, invalidHandler: function () {
            emptyForm()
        }
    });
</script>
<?php include_once "../layout/footer.php"; ?>

