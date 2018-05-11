<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:18 PM
 */

class Genre
{
    private $conn, $nombre;

    /**
     * Genre constructor.
     * @param $conn
     * @param $nombre
     */
    public function __construct($conn, $nombre)
    {
        $this->conn = $conn;
        $this->nombre = $nombre;
    }

    public function save() {
        $sql = "INSERT INTO generos (nombre) VALUES ('{$this->nombre}')";
        return $this -> conn -> exec($sql);
    }

    public function update($id) {
        $sql = "UPDATE generos SET nombre = '{$this->nombre}' WHERE idgeneros = {$id}";
        return $this -> conn -> exec($sql);
    }

    public function delete($conn, $id) {
        $sql = "DELETE FROM generos WHERE idgeneros = {$id}";
        return $conn -> exec($sql);
    }

    public function search($conn, $search) {
        $sql = "SELECT * FROM generos WHERE nombre LIKE '%{$search}%'";
        return $conn -> query($sql);
    }

    public function get($conn, $id) {
        $sql = "SELECT * FROM generos WHERE idgeneros = {$id}";
        return ($conn -> query($sql) -> fetchAll())[0];
    }
}