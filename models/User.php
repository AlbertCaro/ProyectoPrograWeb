<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:19 PM
 */

class User
{
    private $conn, $usuario, $nombre, $apaterno, $amaterno, $pass, $rol;

    /**
     * User constructor.
     * @param $conn
     * @param $usuario
     * @param $nombre
     * @param $apaterno
     * @param $amaterno
     * @param $pass
     * @param $rol
     */
    public function __construct($conn, $usuario, $nombre, $apaterno, $amaterno, $pass, $rol)
    {
        $this->conn = $conn;
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->apaterno = $apaterno;
        $this->amaterno = $amaterno;
        $this->pass = $pass;
        $this->rol = $rol;
    }


    public function save() {
        $sql = "INSERT INTO usuarios (usuario, pass, nombre, apaterno, amaterno, rol)
               VALUES ('{$this->usuario}', MD5('{$this->pass}'), '{$this->nombre}', '{$this->apaterno}', '{$this->amaterno}', 'normal')";
        return $this->conn->exec($sql);
    }

    public function update($id) {
        $sql = "UPDATE usuarios SET
                nombre = '{$this->nombre}',
                apaterno = '{$this->apaterno}',
                amaterno = '{$this->amaterno}'";
        if ($this->pass !== "") {
            $sql .= ", pass = MD5('{$this->pass}')";
        }
        $sql .= " WHERE idusuarios = '{$id}'";

        return $this->conn->exec($sql);
    }

    public function comparePassword($pass_conf) {
        return $this->pass == $pass_conf;
    }

    public function find() {
        $sql = "SELECT * FROM usuarios WHERE usuario = '{$this->usuario}'";
        return $this -> conn -> query($sql) -> rowCount();
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