<?php

require_once "../../controllers/conf.php";
session_start();

$title = "Inicio";
include_once "navbar.php";
?>
<!-- Banner -->
<section id="banner">
    <div class="inner">
        <h1>Musical: <span>la base de datos de<br />
					consulta de música más grande.</span></h1>
        <ul class="actions">
            <li>
            <?php
            if (isset($_SESSION['valid']))
                echo "<a href='song/all/' class='button alt'>Ver canciones</a>";
            else
                echo "<a href='login' class='button alt'>Iniciar sesión</a>"
            ?>
            </li>
        </ul>
    </div>
</section>

<!-- One -->
<section id="one">
    <div class="inner">
        <header>
            <h2>Lista de canciones favoritas</h2>
        </header>
        <p>Registra tus canciones favoritas en el éste sistema, no pierdas la información que te interesa.</p>
        <ul class="actions">
            <li><a href="favorites" class="button alt">Ir a canciones favoritas</a></li>
        </ul>
    </div>
</section>

<!-- Two -->
<section id="two">
    <div class="inner">
        <article>
            <div class="content">
                <header>
                    <h3>Pellentesque adipis</h3>
                </header>
                <div class="image fit">
                    <img src="../../assets/img/pic01.jpg" alt="" />
                </div>
                <p>Cumsan mollis eros. Pellentesque a diam sit amet mi magna ullamcorper vehicula. Integer adipiscin sem. Nullam quis massa sit amet lorem ipsum feugiat tempus.</p>
            </div>
        </article>
        <article class="alt">
            <div class="content">
                <header>
                    <h3>Morbi interdum mol</h3>
                </header>
                <div class="image fit">
                    <img src="../../assets/img/pic02.jpg" alt="" />
                </div>
                <p>Cumsan mollis eros. Pellentesque a diam sit amet mi magna ullamcorper vehicula. Integer adipiscin sem. Nullam quis massa sit amet lorem ipsum feugiat tempus.</p>
            </div>
        </article>
    </div>
</section>

<!-- Three -->
<section id="three">
    <div class="inner">
        <article>
            <div class="content">
                <span class="icon fa-laptop"></span>
                <header>
                    <h3>Tempus Feugiat</h3>
                </header>
                <p>Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna lorem ullamcorper laoreet, lectus arcu.</p>
                <ul class="actions">
                    <li><a href="#" class="button alt">Learn More</a></li>
                </ul>
            </div>
        </article>
        <article>
            <div class="content">
                <span class="icon fa-diamond"></span>
                <header>
                    <h3>Aliquam Nulla</h3>
                </header>
                <p>Ut convallis, sem sit amet interdum consectetuer, odio augue aliquam leo, nec dapibus tortor nibh sed.</p>
                <ul class="actions">
                    <li><a href="#" class="button alt">Learn More</a></li>
                </ul>
            </div>
        </article>
        <article>
            <div class="content">
                <span class="icon fa-laptop"></span>
                <header>
                    <h3>Sed Magna</h3>
                </header>
                <p>Suspendisse mauris. Fusce accumsan mollis eros. Pellentesque a diam sit amet mi ullamcorper vehicula.</p>
                <ul class="actions">
                    <li><a href="#" class="button alt">Learn More</a></li>
                </ul>
            </div>
        </article>
    </div>
    <div id="response" class="12u$"></div>
</section>

<?php include_once "footer.php" ?>