<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:18 PM
 */

require_once "Connection.php";

class Label
{
    private $nombre, $fundacion, $pais;

    /**
     * Label constructor.
     * @param $conn
     * @param $nombre
     * @param $fundacion
     * @param $pais
     */
    public function __construct($nombre, $fundacion, $pais)
    {
        $this->nombre = (String) $nombre;
        $this->fundacion = (int) $fundacion;
        $this->pais = (String) $pais;
    }

    public function save() {
        $sql = "INSERT INTO disqueras (nombre, fundacion, pais) VALUES ('{$this->nombre}', '{$this->fundacion}', '{$this->pais}')";
        return Connection::get() -> exec($sql);
    }

    public function update($id) {
        $sql = "UPDATE disqueras SET nombre='{$this->nombre}', fundacion='{$this->fundacion}', pais='{$this->pais}' WHERE iddisqueras={$id}";
        return Connection::get() -> exec($sql);
    }

    public static function delete($id) {
        $sql = "DELETE FROM disqueras WHERE iddisqueras = {$id}";
        return Connection::get() -> exec($sql);
    }

    public static function search($search) {
        $sql = "SELECT * FROM disqueras WHERE nombre LIKE '%{$search}%' OR fundacion LIKE '%{$search}%'
              OR pais LIKE '{$search}'";
        return Connection::get() -> query($sql);
    }

    public static function get($id) {
        $sql = "SELECT * FROM disqueras WHERE iddisqueras = {$id}";
        return (Connection::get() -> query($sql) -> fetchAll())[0];
    }

    public static function select($value) {
        $sql = "SELECT * FROM disqueras";
        $res = Connection::get() -> query($sql);
        $rows = $res -> fetchAll();
        echo "<option value=''>- Seleccione una opción -</option>";
        foreach ($rows as $row) {
            echo "<option value='{$row['iddisqueras']}' ";
            if ($row['iddisqueras'] === $value)
                echo "selected";
            echo ">{$row['nombre']}</option>";
        }
    }
}