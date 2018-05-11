<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 08:26 AM
 */

class Album
{
    private $conn, $titulo, $tipo, $publicacion, $descripcion, $disquera, $artista;

    /**
     * Album constructor.
     * @param $conn
     * @param $titulo
     * @param $tipo
     * @param $publicacion
     * @param $descripcion
     * @param $disquera
     * @param $artista
     */
    public function __construct($conn, $titulo, $tipo, $publicacion, $descripcion, $disquera, $artista)
    {
        $this->conn = $conn;
        $this->titulo = $titulo;
        $this->tipo = $tipo;
        $this->publicacion = $publicacion;
        $this->descripcion = $descripcion;
        $this->disquera = $disquera;
        $this->artista = $artista;
    }


    public function save() {
        $sql = "INSERT INTO albumes (titulo, tipo, publicacion, descripcion, iddisqueras, idartistas) VALUES 
        ('{$this->titulo}', '{$this->tipo}', '".formatDate($this->publicacion)."', '{$this->descripcion}', {$this->disquera}, {$this->artista})";
        return $this->conn->exec($sql);
    }

    public function update($id) {
        $sql = "UPDATE albumes SET
        titulo='{$this->titulo}',
        tipo='{$this->tipo}', 
        publicacion='".formatDate($this->publicacion)."', 
        descripcion='{$this->descripcion}',
        idartistas='{$this->artista}',
        iddisqueras='{$this->disquera}'
        WHERE idalbumes = {$id}";

        return $this->conn->exec($sql);
    }

    public function delete($conn, $id) {
        $sql = "DELETE FROM albumes WHERE idalbumes = {$id}";
        return $conn -> exec($sql);
    }

    public function get($conn, $id) {
        $sql = "SELECT albumes.*, a.nombre as artista, d.nombre as disquera FROM albumes 
        INNER JOIN artistas a ON albumes.idartistas = a.idartistas
        INNER JOIN disqueras d ON albumes.iddisqueras = d.iddisqueras
        WHERE idalbumes = {$id}";

        return ($conn -> query($sql))->fetchAll()[0];
    }

    public function search($conn, $search) {
        $sql = "SELECT albumes.*, a.nombre, d.nombre FROM albumes 
        INNER JOIN disqueras d ON albumes.iddisqueras = d.iddisqueras 
        INNER JOIN artistas a ON albumes.idartistas = a.idartistas 
        WHERE 
        titulo LIKE '%{$search}%' OR
        tipo LIKE '%{$search}%' OR
        publicacion LIKE '%{$search}%' OR 
        a.nombre LIKE '%{$search}%' OR 
        d.nombre LIKE '%{$search}%'";

        return $conn -> query($sql);
    }
}