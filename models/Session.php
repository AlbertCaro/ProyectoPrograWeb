<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:19 PM
 */

require_once "Connection.php";

class Session
{
    private $usuario, $contrasenia;

    /**
     * Session constructor.
     * @param $conn
     * @param $usuario
     * @param $contrasenia
     */
    public function __construct($usuario, $contrasenia)
    {
        $this->usuario = (String) $usuario;
        $this->contrasenia = (String) md5($contrasenia);
    }

    public function verifyCredentials() {
        return ($this->query() -> rowCount()) !== 0;
    }

    public function get() {
        return ($this->query() -> fetchAll())[0];
    }

    private function query() {
        $sql = "SELECT * FROM usuarios WHERE pass = '{$this->contrasenia}' AND usuario = '{$this->usuario}'";
        return Connection::get() -> query($sql);
    }
}