<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:18 PM
 */

require_once "Connection.php";

class Favorite
{
    private $cancion, $usuario;

    /**
     * Favorite constructor.
     * @param $cancion
     * @param $usuario
     */
    public function __construct($cancion, $usuario)
    {
        $this->cancion = $cancion;
        $this->usuario = $usuario;
    }

    public function save() {
        $sql = "INSERT INTO favoritas (idcanciones, idusuarios) VALUES ({$this->cancion}, {$this->usuario})";
        return Connection::get() -> exec($sql);
    }

    public function delete() {
        $sql = "DELETE FROM favoritas WHERE idcanciones = {$this->cancion} AND idusuarios = {$this->usuario}";
        return Connection::get() -> exec($sql);
    }

    public static function deleteBySongId($id) {
        $sql = "SELECT * FROM favoritas WHERE idcanciones = {$id}";
        if (Connection::get() -> query($sql) -> rowCount()) {
            $sql = "DELETE FROM favoritas WHERE idcanciones = {$id}";
            return Connection::get() -> exec($sql);
        } else
            return true;
    }

    public static function search($search, $id) {
        $sql = "SELECT canciones.idcanciones, canciones.titulo AS cancion, a2.nombre AS artista, a.titulo AS album FROM canciones
                  INNER JOIN albumes a on canciones.idalbumes = a.idalbumes
                  INNER JOIN artistas a2 on a.idartistas = a2.idartistas
                  INNER JOIN favoritas f on canciones.idcanciones = f.idcanciones
                  INNER JOIN usuarios u on f.idusuarios = u.idusuarios WHERE u.idusuarios = {$id} AND 
                  canciones.titulo LIKE '%{$search}%'";
        return Connection::get() -> query($sql);
    }

    public function isFavorite() {
        $sql = "SELECT * FROM favoritas WHERE idcanciones = {$this->cancion} AND idusuarios = {$this->usuario}";
        return Connection::get() -> query($sql) -> rowCount();
    }
}