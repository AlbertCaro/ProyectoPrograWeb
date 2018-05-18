<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 25/04/2018
 * Time: 10:04 AM
 */

$title = "Canciones";

include_once "../layout/session_valid.php";
include_once "../layout/navbar.php";

?>
    <!-- Main -->
    <section id="main" >
        <div class="inner">
            <header class="major special">
                <h1>Ver canciones</h1>
                <p>Administrar canciones registrados.</p>
                <?php include_once "../layout/search_form.php" ?>
            </header>
            <div id="message">

            </div>
            <table>
                <thead>
                <tr>
                    <th></th>
                    <th>Título</th>
                    <th>Artista</th>
                    <th>Album</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="response" class="12u$">

                </tbody>
            </table>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(generateTable());
    </script>
<?php include_once "../layout/footer.php" ?>