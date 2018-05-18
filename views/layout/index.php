<?php

require_once "../../models/Utilities.php";
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
                echo "<a href='song/all' class='button alt'>Ver canciones</a>";
            else
                echo "<a href='login/' class='button alt'>Iniciar sesión</a>"
            ?>
            </li>
        </ul>
    </div>
</section>

<?php
if (isset($_SESSION['valid'])) {
    echo "
    <!-- One -->
<section id=\"one\">
    <div class=\"inner\">
        <header>
            <h2>Lista de canciones favoritas</h2>
        </header>
        <p>Registra tus canciones favoritas en el éste sistema, no pierdas la información que te interesa.</p>
        <ul class=\"actions\">
            <li><a href=\"favorites\" class=\"button alt\">Ir a canciones favoritas</a></li>
        </ul>
    </div>
</section>

<!-- Three -->
<section id=\"three\">
    <div class=\"inner\">
        <article>
            <div class=\"content\">
                <span class=\"icon fa-play\"></span>
                <header>
                    <h3>Millones de albumes</h3>
                </header>
                <p>Se cuenta con la base de datos más grande de albumes que el mundo conozca.</p>
                <ul class=\"actions\">
                    <li><a href=\"album/all\" class=\"button alt\">Ver albumes</a></li>
                </ul>
            </div>
        </article>
        <article>
            <div class=\"content\">
                <span class=\"icon fa-user\"></span>
                <header>
                    <h3>Grandes artistas</h3>
                </header>
                <p>Base de datos de artistas desde el principio de los tiempos, de todos los géneros.</p>
                <ul class=\"actions\">
                    <li><a href=\"#\" class=\"button alt\">Ver artistas</a></li>
                </ul>
            </div>
        </article>
        <article>
            <div class=\"content\">
                <span class=\"icon fa-music\"></span>
                <header>
                    <h3>Sellos discográficos</h3>
                </header>
                <p>Se cuenta con una inmensa cantidad de información referente a compañías discográficas.</p>
                <ul class=\"actions\">
                    <li><a href=\"#\" class=\"button alt\">Learn More</a></li>
                </ul>
            </div>
        </article>
    </div>
    <div id=\"response\" class=\"12u$\"></div>
</section>";
}
?>

<?php include_once "footer.php" ?>