<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:19 PM
 */

require_once "Connection.php";

class User
{
    private $usuario, $nombre, $apaterno, $amaterno, $pass, $rol;

    /**
     * User constructor.
     * @param $conn
     * @param $usuario
     * @param $nombre
     * @param $apaterno
     * @param $amaterno
     * @param $pass
     * @param $rol
     */
    public function __construct($usuario, $nombre, $apaterno, $amaterno, $pass, $rol)
    {
        $this->usuario = (String) $usuario;
        $this->nombre = (String) $nombre;
        $this->apaterno = (String) $apaterno;
        $this->amaterno = (String) $amaterno;
        $this->pass = (String) md5($pass);
        $this->rol = $rol;
    }


    public function save() {
        $sql = "INSERT INTO usuarios (usuario, pass, nombre, apaterno, amaterno, rol)
               VALUES ('{$this->usuario}', '{$this->pass}', '{$this->nombre}', '{$this->apaterno}', '{$this->amaterno}', 'normal')";
        return Connection::get() -> exec($sql);
    }

    public function update() {
        $sql = "UPDATE usuarios SET
                nombre = '{$this->nombre}',
                apaterno = '{$this->apaterno}',
                amaterno = '{$this->amaterno}'";
        if ($this->pass !== "")
            $sql .= ", pass = '{$this->pass}'";
        $sql .= " WHERE usuario = '{$this->usuario}'";

        return Connection::get() -> exec($sql);
    }

    public function comparePassword($pass_conf) {
        return $this->pass == $pass_conf;
    }

    public function find() {
        $sql = "SELECT * FROM usuarios WHERE usuario = '{$this->usuario}'";
        return Connection::get() -> query($sql) -> rowCount();
    }

    public static function delete($id) {
        $sql = "DELETE FROM usuarios WHERE idusuarios = {$id}";
        echo Connection::get() -> exec($sql);
    }

    public static function get($id) {
        $sql = "SELECT * FROM usuarios WHERE idusuarios = {$id}";
        return (Connection::get() -> query($sql)) -> fetchAll()[0];
    }

    public static function search($search) {
        $sql = "SELECT idusuarios, usuario, CONCAT(nombre, ' ', apaterno, ' ', amaterno) as nombreCompleto FROM
usuarios WHERE usuario LIKE '%{$search}%' OR CONCAT(nombre, ' ', apaterno, ' ', amaterno) LIKE '%{$search}%'";
        return Connection::get() -> query($sql);
    }
}