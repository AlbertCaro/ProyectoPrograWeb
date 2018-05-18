<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:18 PM
 */

require_once "Connection.php";

class Genre
{
    private $nombre;

    /**
     * Genre constructor.
     * @param $conn
     * @param $nombre
     */
    public function __construct($nombre)
    {
        $this->nombre = (String) $nombre;
    }

    public function save() {
        $sql = "INSERT INTO generos (nombre) VALUES ('{$this->nombre}')";
        return Connection::get() -> exec($sql);
    }

    public function update($id) {
        $sql = "UPDATE generos SET nombre = '{$this->nombre}' WHERE idgeneros = {$id}";
        return Connection::get() -> exec($sql);
    }

    public static function delete($id) {
        $sql = "DELETE FROM generos WHERE idgeneros = {$id}";
        return Connection::get() -> exec($sql);
    }

    public static function search($search) {
        $sql = "SELECT * FROM generos WHERE nombre LIKE '%{$search}%'";
        return Connection::get() -> query($sql);
    }

    public static function get($id) {
        $sql = "SELECT * FROM generos WHERE idgeneros = {$id}";
        return (Connection::get() -> query($sql) -> fetchAll())[0];
    }

    public static function select($value) {
        $sql = "SELECT * FROM generos";
        $res = Connection::get() -> query($sql);
        $rows = $res -> fetchAll();
        echo "<option value=''>- Seleccione una opción -</option>";
        foreach ($rows as $row) {
            echo "<option value='{$row['idgeneros']}' ";
            if ($row['idgeneros'] === $value)
                echo "selected";
            echo ">{$row['nombre']}</option>";
        }
    }
}