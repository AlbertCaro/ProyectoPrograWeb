<?php

include_once "../layout/session_valid.php";
$title = "Ver artistas";
include_once "../layout/navbar.php";

?>

<!-- Main -->
<section id="main" >
    <div class="inner">
        <header class="major special">
            <h1>Ver géneros</h1>
            <p>Administrar géneros registrados.</p>
            <?php include_once "../layout/search_form.php" ?>
        </header>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <?php if($_SESSION['role'] === "admin") {
                        echo "
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Acciones</th>";
                    } ?>
                </tr>
            </thead>
            <tbody id="response">

            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(generateTable('genre'));
</script>
<?php include_once "../layout/footer.php" ?>