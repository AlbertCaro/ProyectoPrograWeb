<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:10 PM
 */

require_once "../database/conf.php";
require_once "../models/Label.php";

$function = $_POST['func'];
$function();

function table() {
    $res = Label::search($_POST['search']);
    $count = $res -> rowCount();
    require_once "../views/label/row.php";
}

function save() {
    $label = createLabel();
    if ($label -> save()) {
        sweetMessage('Guardado correctamente',
            'Se ha guardado la disquera con éxito.',
            'success',
            'all');
    } else
        message('No se ha podido guardar la disquera', 'alert alert-danger');
}

function update() {
    $label = createLabel();
    if ($label -> update($_POST['id'])) {
        sweetMessage('Actualizado correctamente',
            'Se ha actualizado la disquera con éxito.',
            'success',
            'all');
    } else
        message('No se ha podido actualizar la disquera o no se realizaron cambios.', 'alert alert-danger');
}

function delete() {
    echo Label::delete($_POST['id']);
}

function createLabel() {
    return new Label($_POST['nombre'], $_POST['fundacion'], $_POST['pais']);
}