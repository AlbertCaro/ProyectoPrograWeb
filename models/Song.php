<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:19 PM
 */

require_once "Connection.php";
require_once "Utilities.php";

class Song
{
    private $id, $titulo, $duracion, $genero, $albumes;

    /**
     * Song constructor.
     * @param $conn
     * @param $titulo
     * @param $duracion
     * @param $genero
     * @param $albumes
     */
    public function __construct($titulo, $duracion, $genero, $albumes)
    {
        $this->titulo = (String) $titulo;
        $this->duracion = (String) Utilities::secondsToTime($duracion);
        $this->genero = (int) $genero;
        $this->albumes = (int) $albumes;
    }

    public function save() {
        $sql = "INSERT INTO canciones (titulo, duracion, idgeneros, idalbumes) VALUES
                ('{$this->titulo}', '{$this->duracion}', {$this->genero}, {$this->albumes})";
        $res = Connection::get() -> exec($sql);
        $this->id = Connection::get()->lastInsertId();
        return $res;
    }

    public function update($id) {
        $sql = "UPDATE canciones SET
                  titulo='{$this->titulo}',
                  duracion='{$this->duracion}',
                  idgeneros={$this->genero},
                  idalbumes={$this->albumes} WHERE idcanciones = {$id}";
        return Connection::get() -> exec($sql);
    }

    public static function delete($id) {
        $sql = "DELETE FROM canciones WHERE idcanciones = {$id}";
        return Connection::get() -> exec($sql);
    }

    public static function search($search) {
        $sql = "SELECT canciones.idcanciones, canciones.titulo AS cancion, a2.nombre AS artista, a.titulo AS album FROM canciones
  INNER JOIN albumes a on canciones.idalbumes = a.idalbumes
  INNER JOIN artistas a2 on a.idartistas = a2.idartistas WHERE
                canciones.titulo LIKE '%{$search}%'";
        return Connection::get() -> query($sql);
    }

    public static function get($id) {
        $sql = "SELECT canciones.*, a.titulo as album, a2.nombre as artista, g.nombre as genero FROM canciones
                INNER JOIN albumes a on canciones.idalbumes = a.idalbumes
                INNER JOIN artistas a2 on a.idartistas = a2.idartistas
                INNER JOIN canciones_autores a3 on canciones.idcanciones = a3.idcanciones
                INNER JOIN autores a4 on a3.idautores = a4.idautores
                INNER JOIN disqueras d on a.iddisqueras = d.iddisqueras
                INNER JOIN generos g on canciones.idgeneros = g.idgeneros WHERE
                canciones.idcanciones = {$id}";
        return (Connection::get() -> query($sql) -> fetchAll())[0];
    }

    public static function getAuthors($id, $text) {
        $sql = "SELECT a.idautores, CONCAT(a.nombre,' ',a.apaterno,' ',a.amaterno) as nombre FROM canciones_autores 
                INNER JOIN autores a on canciones_autores.idautores = a.idautores WHERE idcanciones = $id";
        $authors = Connection::get()->query($sql)->fetchAll();
        if ($text) {
            $res = "";
            for ($i = 0; $i < count($authors); $i++) {
                $res .= $authors[$i]['nombre'];
                if ($i+1 != count($authors))
                    $res.=", ";
            }
            $res.=".";
            return $res;
        } else
            return $authors;
    }

    public function linkAuthors($autor) {
        $sql = "SELECT * FROM canciones_autores WHERE idcanciones = {$this->id} AND idautores = {$autor}";
        if (!Connection::get() -> query($sql) -> rowCount()) {
            $sql = "INSERT INTO canciones_autores (idcanciones, idautores) VALUES ({$this->id}, $autor)";
            return Connection::get()->exec($sql);
        } else
            return true;
    }

    public static function unlinkAuthors($id) {
        $sql = "SELECT * FROM canciones_autores WHERE idcanciones = {$id}";
        if (Connection::get() -> query($sql) -> rowCount()) {
            $sql = "DELETE FROM canciones_autores WHERE idcanciones = {$id}";
            return Connection::get() -> exec($sql);
        } else
            return true;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }
}