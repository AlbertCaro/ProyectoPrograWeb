<?php

require_once "../conf.php";

$title = "Agregar usuario";

include_once "../elements/session_valid.php";
include_once "../elements/session_roles.php";

if ($_GET['id'] !== "") {
    $sql = "SELECT * FROM usuarios WHERE idusuarios = {$_GET['id']}";
    $res = $conn -> query($sql);
    $rows = ($res -> fetchAll())[0];
    $title = "Editar usuario";
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
            <h3>Información del usuario</h3>
            <form method="post" id="form">
                <div class="row uniform 50%">
                    <?php
                    if ($_GET['id'] !== "") {
                        echo "
                        <div class=\"6u 12u$(xsmall)\">
                            <input type=\"text\" name=\"user\" id=\"user\" value=\"{$rows['usuario']}\"
                                   placeholder=\"Apellido paterno\" required/>
                        </div>";
                    }

                    ?>
                    <div class="12u 12u$(xsmall)">
                        <input type="text" name="nombre" id="nombre" value="<?php if ($_GET['id'] !== "") echo $rows['nombre'] ?>"
                               placeholder="Nombre(s)" required/>
                        <?php if($_GET['id'] !== "") echo "<input type='hidden' name='id' id='id' value='{$rows['idusuario']}'>" ?>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <input type="text" name="apaterno" id="apaterno" value="<?php if ($_GET['id'] !== "") echo $rows['apaterno'] ?>"
                               placeholder="Apellido paterno" required/>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <input type="text" name="amaterno" id="amaterno" value="<?php if ($_GET['id'] !== "") echo $rows['amaterno'] ?>"
                               placeholder="Apellido materno"/>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <input type="text" name="pass" id="pass" placeholder="Contraseña" <?php if ($_GET['id'] === "") echo 'required' ?> />
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <input type="text" name="pass_conf" id="pass_conf" placeholder="Confirmar contraseña" <?php if ($_GET['id'] === "") echo 'required' ?> />
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
    $("#form").validate({
        rules: {
            pass: {
                minlength: 5
            }, pass_conf: {
                minlength: 5
            }
        },
        messages: {
            nombre: "Debe especificar el nombre del usuario",
            apaterno: "Debe especificar su apellido paterno",
            pass: {
                minlength: "La contraseña debe tener mínimo 5 carácteres"
                <?php if ($_GET['id'] === "") echo ', required: "Debe especificar la contraseña"' ?>
            },
            pass_conf: {
                minlength: "La contraseña debe tener mínimo 5 carácteres"
                <?php if ($_GET['id'] === "") echo ', required: "Debe confirmar la contraseña",' ?>
                equalsTo: "Las contraseñas no coinciden"
            }
        }, submitHandler: function () {
            sendData({
                <?php if ($_GET['id'] !== '') echo '"id" : $(\'#id\').val(),'?>
                "nombre" : $('#nombre').val(),
                "apaterno" : $('#apaterno').val(),
                "amaterno" : $('#amaterno').val(),
                "pass" : $('#pass').val(),
                "pass_conf" : $('#pass_conf').val()
            }, '<?php
                if ($_GET['id'] !== "")
                    echo "../interactors/user/update.php";
                else
                    echo "../interactors/user/save.php"?>');
        }
    });
</script>
<?php include_once "../elements/footer.php"; ?>

