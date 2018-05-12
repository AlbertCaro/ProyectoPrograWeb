<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:18 PM
 */

require_once "Connection.php";

class Author
{
    private $nombre, $apaterno, $amaterno;

    /**
     * Author constructor.
     * @param $nombre
     * @param $apaterno
     * @param $amaterno
     */
    public function __construct($nombre, $apaterno, $amaterno)
    {
        $this->nombre = (String) $nombre;
        $this->apaterno = (String) $apaterno;
        $this->amaterno = (String) $amaterno;
    }

    public function save() {
        $sql = "INSERT INTO autores (nombre, apaterno, amaterno) VALUES ('{$this->nombre}', '{$this->apaterno}', '{$this->amaterno}')";
        return Connection::get()->exec($sql);
    }

    public function update($id) {
        $sql = "UPDATE autores SET nombre='{$this->nombre}', apaterno='{$this->apaterno}', amaterno='{$this->amaterno}' WHERE idautores = {$id}";
        return Connection::get()->exec($sql);
    }

    public static function delete($id) {
        $sql = "DELETE FROM autores WHERE idautores = {$id}";
        return Connection::get() -> exec($sql);
    }

    public static function get($id) {
        $sql = "SELECT * FROM autores WHERE idautores = {$id}";
        return (Connection::get() -> query($sql) -> fetchAll())[0];
    }

    public static function search($search) {
        $sql = "SELECT * FROM autores WHERE CONCAT(nombre,' ',apaterno,' ',amaterno) LIKE '%{$search}%'";
        return Connection::get() -> query($sql);
    }
}