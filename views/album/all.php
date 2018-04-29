<?php

include_once "../elements/session_valid.php";
$title = "Ver artistas";
include_once "../elements/navbar.php";

?>
<script type="text/javascript">
    var interactor = "album";
</script>
<!-- Main -->
<section id="main" >
    <div class="inner">
        <header class="major special">
            <h1>Ver artistas</h1>
            <p>Administrar artistas registrados.</p>
            <form>
                <div class="12u 12u$(xsmall)">
                    <label for="search">Buscar: </label>
                    <input type="text" id="search" name="search" onkeyup="generateTable(interactor)">
                </div>
            </form>
        </header>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>País</th>
                    <th>Año de debut</th>
                </tr>
            </thead>
            <tbody id="response">

            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(generateTable(interactor));
</script>
<?php include_once "../elements/footer.php" ?>