<?php
/**
 * La clase Familia hace relación a la tabla Familias de la base de datos, es decir, va a tener los atributos que correspondan
 * con los campos de la base de datos
 */

namespace Clases;

require '../vendor/autoload.php';

use PDO;

class Familia extends Conexion //hereda de Conexión
{
    //atributos accesibles sólo desde la clase
    private $cod;
    private $nombre;

    /**
     * Familia constructor. LLama al constructor padre, es decir, al constructor de Conexión
     */
    public function __construct()
    {
        parent::__construct();
    }

    //introducimos los getter y los setter, uno para devolver el atributo (get) y el otro para modificarlo (set)
    /**
     * @return mixed
     */
    public function getCod()
    {
        return $this->cod;
    }

    /**
     * @param mixed $cod
     */
    public function setCod($cod)
    {
        $this->cod = $cod;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param
     * @return array
     */
    public function getFamilias()
    {
        //crea la variable de la consulta que se desea hacer
        $consulta = "select cod from familias order by cod"; //selecciona el código de las familias ordenados por código
        $stmt = self::$conexion->prepare($consulta); //prepara la consulta
        try {
            $stmt->execute(); //realiza la consulta de esta manera ya que no tiene ningún parámetro
        } catch (\PDOException $ex) { //si da error
            die("Error al devolver las familias: " . $ex->getMessage());
        }
        while ($fila = $stmt->fetch(PDO::FETCH_OBJ)) { //retorna el resultado de la consulta en forma de objeto, recorriendo el bucle por cada registro que tenga
            $familias[] = $fila->cod; //guarda todas las familias en un array
        }
        return $familias; //devuelve el array
    }
}
