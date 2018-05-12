<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 12/05/2018
 * Time: 12:40 AM
 */

class Connection
{
    private static $instance = null;
    private $host = 'localhost', $username = 'root', $password = '', $database = 'musical';
    private $conn;

    /**
     * Connection constructor.
     */
    private function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
            $this->conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            return false;
        }
    }

    public static function get() {
        if (!self::$instance) {
            self::$instance = new Connection();
        }

        return self::$instance->conn;
    }
}