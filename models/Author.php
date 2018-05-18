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

    public static function select($value, $id, $default) {
        $sql = "SELECT * FROM autores";
        $res = Connection::get() -> query($sql);
        $rows = $res -> fetchAll();
        echo "<div class='11u' id='autor_{$id}'>";
        echo "<select name='autores[]' id='{$id}'";
        if ($default)
            echo " required";
        echo ">";
        echo "<option value=''>- Seleccione una opción -</option>";
        foreach ($rows as $row) {
            echo "<option value='{$row['idautores']}' ";
            if ($row['idautores'] === $value)
                echo "selected";
            echo ">{$row['nombre']} {$row['apaterno']} {$row['amaterno']}</option>";
        }
        echo "</select>";
        echo "</div>";
        if ($default == "false") {
            $function = "destroyInput({$id})";
            $image = "close.png";

        } else {
            $function = "createInput()";
            $image = "plus.png";
        }
        echo "<div class='1u$' id='close_{$id}'>
                <a href='#'>
                    <img src='../assets/img/{$image}' width='24' style=\"vertical-align: middle\" onclick='event.preventDefault(); {$function}'>
                </a>
              </div>";
    }
}