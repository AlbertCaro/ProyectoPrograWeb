<?php

require_once "../../models/Utilities.php";
require_once "../../models/Author.php";

$title = "Agregar autor";

include_once "../layout/session_valid.php";
include_once "../layout/session_roles.php";

if ($_GET['id'] !== "") {
    $rows = Author::get($_GET['id']);
    $title = "Editar autor";
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
            <h3 style="color: #0c0c0c">Información del autor</h3>
            <form method="post" id="form" onsubmit="">
                <div class="row uniform 50%">
                    <div class="12u$">
                        <label for="nombre" style="color: #0c0c0c">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php if ($_GET['id'] !== "") echo $rows['nombre'] ?>"
                               placeholder="Nombre(s)" required/>
                        <?php if($_GET['id'] !== "") echo "<input type='hidden' name='id' id='id' value='{$rows['idautores']}'>" ?>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <label for="apaterno" style="color: #0c0c0c">Apellido paterno:</label>
                        <input type="text" name="apaterno" id="apaterno" value="<?php if ($_GET['id'] !== "") echo $rows['apaterno'] ?>"
                               placeholder="Apellido paterno" required/>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <label for="amaterno" style="color: #0c0c0c">Apellido materno:</label>
                        <input type="text" name="amaterno" id="amaterno" value="<?php if ($_GET['id'] !== "") echo $rows['amaterno'] ?>"
                               placeholder="Apellido materno"/>
                    </div>
                    <div id="response" class="12u$">

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
    $("#form").validate({
        messages: {
            nombre: "Debe especificar el nombre",
            apaterno: "Debe especificar el apellido paterno"
        }, submitHandler: function () {
            sendData({
                <?php if ($_GET['id'] !== '') echo '"id" : $(\'#id\').val(),'?>
                "nombre" : $('#nombre').val(),
                "apaterno" : $('#apaterno').val(),
                "amaterno" : $('#amaterno').val(),
                "func" : '<?php if ($_GET['id'] !== "") echo "update"; else echo "save"?>'
            }, 'controller/');
        }, invalidHandler: function () {
            emptyForm()
        }
    });
</script>
<?php include_once "../layout/footer.php"; ?>

