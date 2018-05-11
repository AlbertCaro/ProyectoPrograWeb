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
        $this->retiro = $retiro;
    }


    public function save() {
        $sql = "INSERT INTO artistas (nombre, descripcion, pais, debut";
        if ($this->retiro !== "")
            $sql.= ", retiro";
        $sql.=") VALUES
                ('{$this->nombre}', '{$this->descripcion}', '{$this->pais}', '{$this->debut}'";
        if ($this->retiro)
            $sql.=", '{$this->retiro}'";
        $sql.=")";
        return $this->conn->exec($sql);
    }

    public function update($id) {
        $sql = "UPDATE artistas SET
        nombre='{$this->nombre}',
        pais='{$this->pais}', 
        debut='{$this->debut}', ";

        if ($this->retiro !== "")
            $sql.="retiro='{$this->retiro}', ";

        $sql.="descripcion='{$this->descripcion}' WHERE idartistas={$id}";
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