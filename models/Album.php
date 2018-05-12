<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 03/05/2018
 * Time: 08:26 AM
 */

require_once "Utilities.php";
require_once "Connection.php";

class Album
{
    private $titulo, $tipo, $publicacion, $descripcion, $disquera, $artista;

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
    public function __construct($titulo, $tipo, $publicacion, $descripcion, $disquera, $artista)
    {
        $this->titulo = (String) $titulo;
        $this->tipo = (String) $tipo;
        $this->publicacion = Utilities::formatDate((String) $publicacion);
        $this->descripcion = (String) $descripcion;
        $this->disquera = (int) $disquera;
        $this->artista = (int) $artista;
    }


    public function save() {
        $sql = "INSERT INTO albumes (titulo, tipo, publicacion, descripcion, iddisqueras, idartistas) VALUES 
        ('{$this->titulo}', '{$this->tipo}', '{$this->publicacion}', '{$this->descripcion}', {$this->disquera}, {$this->artista})";
        return Connection::get() -> exec($sql);
    }

    public function update($id) {
        $sql = "UPDATE albumes SET
        titulo='{$this->titulo}',
        tipo='{$this->tipo}', 
        publicacion='{$this->publicacion}', 
        descripcion='{$this->descripcion}',
        idartistas='{$this->artista}',
        iddisqueras='{$this->disquera}'
        WHERE idalbumes = {$id}";
        return Connection::get() -> exec($sql);
    }

    public static function delete($id) {
        $sql = "DELETE FROM albumes WHERE idalbumes = {$id}";
        return Connection::get() -> exec($sql);
    }

    public static function get($id) {
        $sql = "SELECT albumes.*, a.nombre as artista, d.nombre as disquera FROM albumes 
        INNER JOIN artistas a ON albumes.idartistas = a.idartistas
        INNER JOIN disqueras d ON albumes.iddisqueras = d.iddisqueras
        WHERE idalbumes = {$id}";

        return (Connection::get() -> query($sql))->fetchAll()[0];
    }

    public static function search($search) {
        $sql = "SELECT albumes.*, a.nombre, d.nombre FROM albumes 
        INNER JOIN disqueras d ON albumes.iddisqueras = d.iddisqueras 
        INNER JOIN artistas a ON albumes.idartistas = a.idartistas 
        WHERE 
        titulo LIKE '%{$search}%' OR
        tipo LIKE '%{$search}%' OR
        publicacion LIKE '%{$search}%' OR 
        a.nombre LIKE '%{$search}%' OR 
        d.nombre LIKE '%{$search}%'";

        return Connection::get() -> query($sql);
    }

    public static function select($value) {
        $sql = "SELECT * FROM albumes";
        $res = Connection::get() -> query($sql);
        $rows = $res -> fetchAll();
        echo "<option value=''>- Seleccione una opción -</option>";
        foreach ($rows as $row) {
            echo "<option value='{$row['idalbumes']}' ";
            if ($row['idalbumes'] === $value)
                echo "selected";
            echo ">{$row['titulo']}</option>";
        }
    }
}