<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 12:19 PM
 */

require_once "Connection.php";

class Song
{
    private $titulo, $duracion, $genero, $albumes;

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
        $this->duracion = (String) $duracion;
        $this->genero = (int) $genero;
        $this->albumes = (int) $albumes;
    }

    public function save() {
        $sql = "INSERT INTO canciones (titulo, duracion, idgeneros, idalbumes) VALUES
                ('{$this->titulo}', '{$this->duracion}', {$this->genero}, {$this->albumes})";
        return Connection::get() -> exec($sql);
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

    public function deleteAuthorsRelation($id) {
        $sql = "DELETE FROM canciones_autores WHERE idcanciones = {$id}";
        return Connection::get() -> exec($sql);
    }

    public static function search($search) {
        $sql = "SELECT * FROM canciones
                INNER JOIN albumes a on canciones.idalbumes = a.idalbumes
                INNER JOIN artistas a2 on a.idartistas = a2.idartistas
                INNER JOIN canciones_autores a3 on canciones.idcanciones = a3.idcanciones
                INNER JOIN autores a4 on a3.idautores = a4.idautores
                INNER JOIN disqueras d on a.iddisqueras = d.iddisqueras
                INNER JOIN generos g on canciones.idgeneros = g.idgeneros WHERE
                canciones.titulo LIKE '%{$search}%'";
        return Connection::get() -> query($sql);
    }

    public static function get($id) {
        $sql = "SELECT * FROM canciones
                INNER JOIN albumes a on canciones.idalbumes = a.idalbumes
                INNER JOIN artistas a2 on a.idartistas = a2.idartistas
                INNER JOIN canciones_autores a3 on canciones.idcanciones = a3.idcanciones
                INNER JOIN autores a4 on a3.idautores = a4.idautores
                INNER JOIN disqueras d on a.iddisqueras = d.iddisqueras
                INNER JOIN generos g on canciones.idgeneros = g.idgeneros WHERE
                canciones.idcanciones = {$id}";
        return (Connection::get() -> query($sql) -> fetchAll())[0];
    }
}