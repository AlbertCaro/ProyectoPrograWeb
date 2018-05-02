<?php

include_once "../layout/session_valid.php";
$title = "Ver artistas";
include_once "../layout/navbar.php";

?>

<!-- Main -->
<section id="main" >
    <div class="inner">
        <header class="major special">
            <h1>Ver disqueras</h1>
            <p>Administrar disqueras registrados.</p>
            <?php include_once "../layout/search_form.php" ?>
        </header>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fundación</th>
                    <th>País</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="response">

            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(generateTable());
</script>
<?php include_once "../layout/footer.php" ?>