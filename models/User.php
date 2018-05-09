<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:19 PM
 */

class User
{
    private $conn, $usuario, $nombre, $apaterno, $amaterno, $rol;

    /**
     * User constructor.
     * @param $conn
     * @param $usuario
     * @param $nombre
     * @param $apaterno
     * @param $amaterno
     * @param $rol
     */
    public function __construct($conn, $usuario, $nombre, $apaterno, $amaterno, $rol)
    {
        $this->conn = $conn;
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->apaterno = $apaterno;
        $this->amaterno = $amaterno;
        $this->rol = $rol;
    }

    public function save() {

    }

    public function update() {

    }

    public function delete($conn, $id) {
        $sql = "DELETE FROM usuarios WHERE idusuarios = {$id}";
        echo $conn -> exec($sql);
    }

    public function getUser($conn, $id) {
        $sql = "SELECT * FROM usuarios WHERE idusuarios = {$id}";
        return ($conn -> query($sql)) -> fetchAll()[0];
    }

    public function searchArtist($conn, $search) {
        $sql = "SELECT idusuarios, usuario, CONCAT(nombre, ' ', apaterno, ' ', amaterno) as nombreCompleto FROM
usuarios WHERE usuario LIKE '%{$search}%' OR CONCAT(nombre, ' ', apaterno, ' ', amaterno) LIKE '%{$search}%'";
        return $conn -> query($sql);
    }
}