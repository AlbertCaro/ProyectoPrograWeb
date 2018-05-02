<?php

include_once "../layout/session_valid.php";
$title = "Ver artistas";
include_once "../layout/navbar.php";

?>
<script type="text/javascript">
    var interactor = "album";
</script>
<!-- Main -->
<section id="main" >
    <div class="inner">
        <header class="major special">
            <h1>Ver artistas</h1>
            <p>Administrar albums registrados.</p>
            <?php include_once "../layout/search_form.php" ?>
        </header>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Título</th>
                    <th>Fecha de publicación</th>
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
<?php include_once "../layout/footer.php" ?>