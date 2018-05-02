<?php

require_once "../../controllers/conf.php";

$title = "Agregar album";

include_once "../layout/session_valid.php";
include_once "../layout/session_roles.php";

if ($_GET['id'] !== "") {
    $sql = "SELECT * FROM albumes WHERE idalbumes = {$_GET['id']}";
    $res = $conn -> query($sql);
    $rows = ($res -> fetchAll())[0];
    $title = "Editar album";
}

include_once "../layout/navbar.php";

function typeOptions($selected) {
    $types = ['LP', 'EP', 'Demo', 'Single'];
    echo "<option value=''>- Seleccione una opción -</option>";
    foreach ($types as $type) {
        echo "<option value='{$type}'";
        if ($type === $selected)
            echo "selected";
        echo ">{$type}</option>";
    }
}

?>
<!-- Main -->
<section id="main" >
    <div class="inner">
        <header class="major special">
            <h1><?php echo $title ?></h1>
        </header>
        <section>
            <h3 style="color: #1c1c1c">Información del album</h3>
            <form method="post" id="form" onsubmit="">
                <div class="row uniform 50%">
                    <div class="12u 12u$(xsmall)">
                        <label for="titulo" style="color: #1c1c1c">Título:</label>
                        <input type="text" name="titulo" id="titulo" value="<?php if ($_GET['id'] !== "") echo $rows['nombre'] ?>"
                               placeholder="Título del album" required/>
                        <?php if($_GET['id'] !== "") echo "<input type='hidden' name='id' id='id' value='{$rows['idalbumes']}'>" ?>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <label for="tipo" style="color: #1c1c1c">Tipo de disco:</label>
                        <select type="text" name="tipo" id="tipo" required>
                            <?php if($_GET['id'] !== "") typeOptions($rows['tipo']); else typeOptions(null); ?>
                        </select>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <label for="publicacion" style="color: #1c1c1c">Fecha de publicación</label>
                        <input type="text" name="publicacion" id="publicacion" value="<?php if ($_GET['id'] !== "") echo $rows['publicacion'] ?>"
                               placeholder="Fecha de publicación" required/>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <label for="disquera" style="color: #1c1c1c">Disquera:</label>
                        <select type="text" name="disquera" id="disquera" required>
                            <?php
                            if($_GET['id'] !== "") tableSelect($conn, $rows['iddisqueras'], 'disqueras', 'iddisqueras');
                            else tableSelect($conn, null, 'disqueras', 'iddisqueras');
                            ?>
                        </select>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <label for="artista" style="color: #1c1c1c">Artista:</label>
                        <select type="text" name="artista" id="artista" required>
                            <?php
                            if($_GET['id'] !== "") tableSelect($conn, $rows['idartistas'], 'artistas', 'idartistas');
                            else tableSelect($conn, null, 'artistas', 'idartistas');
                            ?>
                        </select>
                    </div>
                    <div class="12u$">
                        <label for="descripcion" style="color: #1c1c1c">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" placeholder="Descripción..." rows="5" required><?php
                            if ($_GET['id'] !== "") echo $rows['descripcion'] ?></textarea>
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
    $("#debut").yearselect({
        order: 'desc',
        minLength:1,
        autoFocus:true
    });

    $("#disquera").autocomplete({
        source: '../artist/controller/array'
    });

    $("#publicacion").datepicker({
        language: "es",
        orientation: "bottom auto"
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
                <?php if ($_GET['id'] !== '') echo '"id" : $(\'#id\').val(),'?>
                "titulo" : $('#titulo').val(),
                "tipo" : $('#tipo').val(),
                "publicacion" : $('#publicacion').val(),
                "descripcion" : $('#descripcion').val(),
                "disquera" : $('#disquera').val(),
                "artista" : $('#artista').val(),
                "func" : '<?php if ($_GET['id'] !== "") echo "update"; else echo "save"?>'
            }, 'controller/');
        }, invalidHandler: function () {
            emptyForm()
        }
    });
</script>
<?php include_once "../layout/footer.php"; ?>

