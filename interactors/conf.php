<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 22/04/2018
 * Time: 10:16 PM
 */

if ($_SERVER['HTTP_HOST'] == "localhost") {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "musical";
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "<h1>Me conecté.</h1>";
} catch (PDOException $exception) {
    echo "<h1>Whoops, no me conecté: ".$exception->getMessage()."</h1>";
}

//Funciones de uso común

function redirect($menssage, $location) {
    echo "<script type='text/javascript'>alert('{$menssage}')</script>";
    echo "<script type='text/javascript'>setTimeout(\"location.href='$location'\", 0);</script>";
}

function sweetMessage($title, $menssage, $type, $location) {
    echo "<script type='text/javascript'>
    swal(
        '{$title}',
        '{$menssage}',
        '{$type}').then(function () { 
            setTimeout(\"location . href = '$location'\", 0);
         })
    </script>";
}

function error($field) {
    echo "<script type='text/javascript'>document.getElementById('$field').style.backgroundColor = '#f79694'</script>";
}

function detectEmptyRows($post) {
    $continue = true;
    $focus = true;
    $count = 0;
    foreach ($post as $item) {
        if ($item === ""){
            $field = array_keys($_POST, $item)[$count];
            if ($focus) {
                echo "<script type='text/javascript'>document.getElementById('{$field}').focus()</script>";
                $focus = false;
            }
            $continue = false;
            error(array_keys($_POST, $item)[$count]);
            $count++;
        }
    }
    return $continue;
}

function message($message, $type) {
    echo "<div id=\"message\" class=\"$type\">
            <a href=\"#\" onclick=\"fadeMessage()\" class=\"close\" title=\"close\">×</a>
            <span>{$message}</span>
          </div>";
}