<?php

require_once "../../models/Utilities.php";
require_once "../../models/User.php";

$title = "Agregar usuario";

include_once "../layout/session_valid.php";
include_once "../layout/session_roles.php";

if ($_GET['id'] !== "") {
    $rows = User::get($_GET['id']);
    $title = "Editar usuario";
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
            <h3 style="color: #1C1C1C">Información del usuario</h3>
            <form method="post" id="form">
                <div class="row uniform 50%">
                    <?php
                    if ($_GET['id'] === "") {
                        echo "
                        <div class=\"6u 12u$(xsmall)\">
                            <label for='user' style=\"color: #1C1C1C\">Usuario:</label>
                            <input type=\"text\" name=\"user\" id=\"user\" placeholder=\"Usuario\" required/>
                        </div>";
                    }
                    ?>
                    <div class="<?php if ($_GET['id'] === "") echo "6u"; else echo "12u";?> 12u$(xsmall)">
                        <label for='nombre' style="color: #1C1C1C">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php if ($_GET['id'] !== "") echo $rows['nombre'] ?>"
                               placeholder="Nombre(s)" required/>
                        <?php if($_GET['id'] !== "") echo "<input type='hidden' name='user' id='user' value='{$rows['usuario']}'>" ?>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <label for='apaterno' style="color: #1C1C1C">Apellido paterno:</label>
                        <input type="text" name="apaterno" id="apaterno" value="<?php if ($_GET['id'] !== "") echo $rows['apaterno'] ?>"
                               placeholder="Apellido paterno" required/>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <label for='amaterno' style="color: #1C1C1C">Apellido materno:</label>
                        <input type="text" name="amaterno" id="amaterno" value="<?php if ($_GET['id'] !== "") echo $rows['amaterno'] ?>"
                               placeholder="Apellido materno"/>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <label for='pass' style="color: #1C1C1C">Contraseña:</label>
                        <input type="password" name="pass" id="pass" placeholder="Contraseña" <?php if ($_GET['id'] === "") echo 'required' ?> />
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <label for='pass_conf' style="color: #1C1C1C">Confirmar contraseña:</label>
                        <input type="password" name="pass_conf" id="pass_conf" placeholder="Confirmar contraseña" <?php if ($_GET['id'] === "") echo 'required' ?> />
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
        rules: {
            user: {
                minlength: 5
            },
            pass: {
                minlength: 5
            }, pass_conf: {
                minlength: 5
            }
        },
        messages: {
            user: {
                required: "El usuario no puede quedar vacío",
                minlength: "El usuario debe contar con mínimo 5 carácteres"
            },
            nombre: "Debe especificar el nombre del usuario",
            apaterno: "Debe especificar su apellido paterno",
            pass: {
                minlength: "La contraseña debe tener mínimo 5 carácteres"
                <?php if ($_GET['id'] === "") echo ', required: "Debe especificar la contraseña"' ?>
            },
            pass_conf: {
                minlength: "La contraseña debe tener mínimo 5 carácteres",
                <?php if ($_GET['id'] === "") echo ' required: "Debe confirmar la contraseña",' ?>
                equalsTo: "Las contraseñas no coinciden"
            }
        }, submitHandler: function () {
            sendData({
                "user" : $("#user").val(),
                "nombre" : $('#nombre').val(),
                "apaterno" : $('#apaterno').val(),
                "amaterno" : $('#amaterno').val(),
                "pass" : $('#pass').val(),
                "pass_conf" : $('#pass_conf').val(),
                "func" : '<?php if ($_GET['id'] !== "") echo "update"; else echo "save"?>'
            }, 'controller/');
        }, invalidHandler: function () {
            emptyForm()
        }
    });
</script>
<?php include_once "../layout/footer.php"; ?>

