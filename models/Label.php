<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:18 PM
 */

class Label
{
    private $conn, $nombre, $fundacion, $pais;

    /**
     * Label constructor.
     * @param $conn
     * @param $nombre
     * @param $fundacion
     * @param $pais
     */
    public function __construct($conn, $nombre, $fundacion, $pais)
    {
        $this->conn = $conn;
        $this->nombre = $nombre;
        $this->fundacion = $fundacion;
        $this->pais = $pais;
    }

    public function save() {
        $sql = "INSERT INTO disqueras (nombre, fundacion, pais) VALUES ('{$this->nombre}', '{$this->fundacion}', '{$this->pais}')";
        return $this->conn->exec($sql);
    }

    public function update($id) {
        $sql = "UPDATE disqueras SET nombre='{$this->nombre}', fundacion='{$this->fundacion}', pais='{$this->pais}' WHERE iddisqueras={$id}";
        return $this->conn->exec($sql);
    }

    public function delete($conn, $id) {
        $sql = "DELETE FROM disqueras WHERE iddisqueras = {$id}";
        return $conn -> exec($sql);
    }

    public function searchLabel($conn, $search) {
        $sql = "SELECT * FROM disqueras WHERE nombre LIKE '%{$search}%' OR fundacion LIKE '%{$search}%'
              OR pais LIKE '{$search}'";
        return $conn -> query($sql);
    }
}