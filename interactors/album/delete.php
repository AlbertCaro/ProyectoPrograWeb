<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 26/04/2018
 * Time: 09:31 AM
 */

require_once "../conf.php";

$sql = "DELETE FROM artistas WHERE idartistas = {$_POST['id']}";
echo $conn -> exec($sql);