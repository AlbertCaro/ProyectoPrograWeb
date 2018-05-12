<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 09:15 AM
 */

require_once "Connection.php";

class Artist
{
    private $nombre, $descripcion, $pais, $debut, $retiro;

    /**
     * Artist constructor.
     * @param $nombre
     * @param $descripcion
     * @param $pais
     * @param $debut
     * @param $retiro
     */
    public function __construct($nombre, $descripcion, $pais, $debut, $retiro)
    {
        $this->nombre = (String) $nombre;
        $this->descripcion = (String) $descripcion;
        $this->pais = (String) $pais;
        $this->debut = (int) $debut;
        $this->retiro = (int) $retiro;
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
        return Connection::get()->exec($sql);
    }

    public function update($id) {
        $sql = "UPDATE artistas SET
        nombre='{$this->nombre}',
        pais='{$this->pais}', 
        debut='{$this->debut}', ";

        if ($this->retiro !== "")
            $sql.="retiro='{$this->retiro}', ";

        $sql.="descripcion='{$this->descripcion}' WHERE idartistas={$id}";
        return Connection::get()->exec($sql);
    }

    public static function delete($id) {
        $sql = "DELETE FROM artistas WHERE idartistas = {$id}";
        return Connection::get()->exec($sql);
    }

    public static function get($id) {
        $sql = "SELECT * FROM artistas WHERE idartistas = {$id}";
        return (Connection::get() -> query($sql))->fetchAll()[0];
    }

    public static function search($search) {
        $sql = "SELECT * FROM artistas WHERE nombre LIKE '%{$search}%' OR pais LIKE '%{$search}%' OR debut LIKE '%{$search}%'";
        return Connection::get() -> query($sql);
    }
}