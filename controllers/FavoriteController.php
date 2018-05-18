<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 29/04/2018
 * Time: 01:08 PM
 */

require_once "../models/Utilities.php";
require_once "../models/Favorite.php";
require_once "../models/Song.php";

$function = $_POST['func'];
$function();

function table() {
    session_start();
    $res = Favorite::search($_POST['search'], $_SESSION['id']);
    $count = $res -> rowCount();
    require_once "../views/song/row.php";
}

function detail() {
    $song = Song::get($_POST['id']);
    $show_buttons = false;
    require_once "../views/song/detail.php";
}

function unsetFavorite() {
    session_start();
    $favorite = new Favorite($_POST['fav'], $_SESSION['id']);

    if ($favorite -> delete()) {
        echo "unsetted";
    } else {
        echo "failed";
    }
}