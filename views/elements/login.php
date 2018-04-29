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
                <form>
                    <div class="row uniform 50%">
                        <div class="12u$">
                            <input type="text" name="user" id="user" placeholder="Ingresa tu usuario, código o email"
                                   onkeyup="focusField('user')" required/>
                        </div>
                        <div class="12u$">
                            <input type="password" name="pass" id="pass" placeholder="Contraseña"
                                   onkeyup="focusField('pass')" required/>
                            <p style="font-size: 14px"><a href="">Olvidé la contraseña.</a></p>
                        </div>
                        <div id="response" class="12u$">

                        </div>
                        <div class="12u$">
                            <ul class="actions">
                                <li><input type="submit" value="Iniciar sesión" class="special" onclick="login(event);"/></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </div>
</section>

<script type="text/javascript">
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';

        window.addEventListener('load', function() {
            var form = document.getElementById('needs-validation');
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }, false);
    })();

    function login(event) {
        event.preventDefault();
        sendData({
            "user" : $("#user").val(),
            "pass" : $("#pass").val()
        }, 'interactors/session/signin.php');
    }
</script>
<?php include_once "footer.php" ?>