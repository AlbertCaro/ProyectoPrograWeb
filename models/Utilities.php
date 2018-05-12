<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 22/04/2018
 * Time: 10:16 PM
 */

trait Utilities {
    //Funciones de uso común

    public static function redirect($menssage, $location) {
        echo "<script type='text/javascript'>alert('{$menssage}')</script>";
        echo "<script type='text/javascript'>setTimeout(\"location.href='$location'\", 0);</script>";
    }

    public static function sweetMessage($title, $menssage, $type, $location) {
        echo "<script type='text/javascript'>
    swal(
        '{$title}',
        '{$menssage}',
        '{$type}').then(function () { 
            setTimeout(\"location . href = '$location'\", 0);
         })
    </script>";
    }

    public static function message($message, $type) {
        echo "<div id=\"message\" class=\"$type\">
            <a href=\"#\" onclick=\"fadeMessage()\" class=\"close\" title=\"close\">×</a>
            <span>{$message}</span>
          </div>";
    }

    public static function formatDate($date) {
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }

    public static function deformatDate($date) {
        return date('d/m/Y', strtotime(str_replace('-', '/', $date)));
    }
}
