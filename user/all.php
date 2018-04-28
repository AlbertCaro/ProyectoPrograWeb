<?php

include_once "../elements/session_valid.php";
$title = "Ver artistas";
include_once "../elements/navbar.php";

?>

<!-- Main -->
<section id="main" >
    <div class="inner">
        <header class="major special">
            <h1>Ver artistas</h1>
            <p>Administrar artistas registrados.</p>
            <form>
                <div class="12u 12u$(xsmall)">
                    <label for="search">Buscar: </label>
                    <input type="text" id="search" name="search" onkeyup="generateTable()">
                </div>
            </form>
        </header>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Usuario</th>
                    <th>Nombre completo</th>
                </tr>
            </thead>
            <tbody id="response">

            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(generateTable());

    function confirmDelete(name, id) {
        swal({
            title: '¿Desea eliminar el artista?',
            text: "Está a punto de eliminar a "+name,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar'
        }).then(function (result) {
            console.log(result.value);
            if (result.value) {
                sendDataDelete({
                    "id" : id
                }, '../interactors/user/delete.php',
                'Usuario eliminado correctamente.',
                'No se ha podido eliminar el usuario correctamente.')
        }
    });
    }
    
    function showDetail(id, field, event) {
        event.preventDefault();
        sendDataDiv({
            id : id
        }, '../interactors/user/detail.php',
        field);
        document.getElementById("detail_button_"+id)
            .setAttribute('onclick', 'hideDetail("'+id+'","#detail_'+id+'", event)');
        document.getElementById("image_"+id)
            .setAttribute('src', '../images/minus.png');
    }

    function hideDetail(id, field, event) {
        event.preventDefault();
        $(field).html("");
        document.getElementById("detail_button_"+id)
            .setAttribute('onclick', 'showDetail("'+id+'", "#detail_'+id+'", event)');
        document.getElementById("image_"+id)
            .setAttribute('src', '../images/more.png');
    }

    function generateTable(){
        sendData({
            "search" : $('#search').val()
        }, '../interactors/user/table.php');
    }
</script>
<?php include_once "../elements/footer.php" ?>