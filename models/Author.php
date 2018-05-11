<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:18 PM
 */

class Author
{
    private $conn, $nombre, $apaterno, $amaterno;

    /**
     * Author constructor.
     * @param $conn
     * @param $nombre
     * @param $apaterno
     * @param $amaterno
     */
    public function __construct($conn, $nombre, $apaterno, $amaterno)
    {
        $this->conn = $conn;
        $this->nombre = $nombre;
        $this->apaterno = $apaterno;
        $this->amaterno = $amaterno;
    }

    public function save() {
        $sql = "INSERT INTO autores (nombre, apaterno, amaterno) VALUES ('{$this->nombre}', '{$this->apaterno}', '{$this->amaterno}')";
        return $this->conn->exec($sql);
    }

    public function update($id) {
        $sql = "UPDATE autores SET nombre='{$this->nombre}', apaterno='{$this->apaterno}', amaterno='{$this->amaterno}' WHERE idautores = {$id}";
        return $this->conn->exec($sql);
    }

    public function delete($conn, $id) {
        $sql = "DELETE FROM autores WHERE idautores = {$id}";
        return $conn -> exec($sql);
    }

    public function getAuthor($conn, $id) {
        $sql = "SELECT * FROM autores WHERE idautores = {$id}";
        return ($conn -> query($sql) -> fetchAll())[0];
    }

    public function searchAuthor($conn, $search) {
        $sql = "SELECT * FROM autores WHERE CONCAT(nombre,' ',apaterno,' ',amaterno) LIKE '%{$search}%'";
        return $conn -> query($sql);
    }
}