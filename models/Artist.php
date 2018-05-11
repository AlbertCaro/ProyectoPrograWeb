<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 09:15 AM
 */

class Artist
{
    private $conn, $nombre, $descripcion, $pais, $debut, $retiro;

    /**
     * Artist constructor.
     * @param $conn
     * @param $nombre
     * @param $descripcion
     * @param $pais
     * @param $debut
     * @param $retiro
     */
    public function __construct($conn, $nombre, $descripcion, $pais, $debut, $retiro)
    {
        $this->conn = $conn;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->pais = $pais;
        $this->debut = $debut;
        if ($retiro == "")
            $this->retiro = null;
        else
            $this->retiro = $retiro;
    }


    public function save() {
        $sql = "INSERT INTO artistas (nombre, descripcion, pais, debut, retiro) VALUES
                ('{$this->nombre}', '{$this->descripcion}', '{$this->pais}', '{$this->debut}', '{$this->retiro}')";
        return $this->conn->exec($sql);
    }

    public function update($id) {
        $sql = "UPDATE artistas SET
        nombre='{$this->nombre}',
        pais='{$this->pais}', 
        debut='{$this->debut}', 
        retiro='{$this->retiro}', 
        descripcion='{$this->descripcion}' WHERE idartistas={$id}";
        return $this->conn->exec($sql);
    }

    public function delete($conn, $id) {
        $sql = "DELETE FROM artistas WHERE idartistas = {$id}";
        return $conn->exec($sql);
    }

    public function get($conn, $id) {
        $sql = "SELECT * FROM artistas WHERE idartistas = {$id}";
        return ($conn -> query($sql))->fetchAll()[0];
    }

    public function search($conn, $search) {
        $sql = "SELECT * FROM artistas WHERE nombre LIKE '%{$search}%' OR pais LIKE '%{$search}%' OR debut LIKE '%{$search}%'";
        return $conn -> query($sql);
    }
}