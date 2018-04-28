<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 27/04/2018
 * Time: 08:16 PM
 */

session_start();
if (!isset($_SESSION['valid']))
    header("Location:../");