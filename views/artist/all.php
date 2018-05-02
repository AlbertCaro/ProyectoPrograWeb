<?php

include_once "../layout/session_valid.php";
$title = "Ver artistas";
include_once "../layout/navbar.php";

?>

<!-- Main -->
<section id="main" >
    <div class="inner">
        <header class="major special">
            <h1>Ver artistas</h1>
            <p>Administrar artistas registrados.</p>
            <?php include_once "../layout/search_form.php" ?>
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
            <tbody id="response" class="12u$">

            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(generateTable('artist'));
</script>
<?php include_once "../layout/footer.php" ?>