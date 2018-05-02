<?php

session_start();
if (isset($_SESSION['valid']))
    header("Location:index");

$title = "Iniciar sesión";
include_once "navbar.php";
?>

<!-- Main -->
<section id="main" >
    <div class="inner" align="center">
        <header>
            <h1>Bienvenido/a</h1>
        </header>
    </div>
</section>
<!-- Two -->
<section id="two">
    <div class="inner" align="center">
        <article>
            <div class="content">
                <div class="image fit">
                    <img src="" alt="" />
                </div>
            </div>
        </article>
        <article class="alt">
            <div class="content">
                <header>
                    <h3>Inicia sesión</h3>
                </header>
                <form id="form">
                    <div class="row uniform 50%">
                        <div class="12u$">
                            <input type="text" name="user" id="user" placeholder="Ingresa tu usuario, código o email" required/>
                        </div>
                        <div class="12u$">
                            <input type="password" name="pass" id="pass" placeholder="Contraseña" required/>
                            <p style="font-size: 14px"><a href="">Olvidé la contraseña.</a></p>
                        </div>
                        <div id="response" class="12u$">

                        </div>
                        <div class="12u$">
                            <ul class="actions">
                                <li><input type="submit" value="Iniciar sesión" class="special"/></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </div>
</section>
<script type="text/javascript">
    $("#form").validate({
        messages: {
            user: "El usuario no puede quedar vacío",
            pass: "La contraseña no puede quedar vacía"
        }, submitHandler: function () {
            sendData({
                "user" : $("#user").val(),
                "pass" : $("#pass").val(),
                "func" : "signin"
            }, 'controller/');
        }, invalidHandler: function () {
            emptyForm()
        }
    })
</script>
<?php include_once "footer.php" ?>