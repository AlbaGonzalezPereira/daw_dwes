<?php
/**
 * La clase Producto hace relación a la tabla Productos de la base de datos, es decir, va a tener los atributos que correspondan
 * con los campos de la base de datos
 */

namespace Clases;

require '../vendor/autoload.php';

use \PDO;

class Tienda extends Conexion
{
    //atributos accesibles sólo desde la clase
    private $id;
    private $nombre;
    private $tlf;

    /**
     * Tienda constructor. LLama al constructor padre, es decir, al constructor de Conexión
     */
    public function __construct()
    {
        parent::__construct();
    }

    //introducimos los getter y los setter, uno para devolver el atributo (get) y el otro para modificarlo (set)
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    //introducimos los getter y los setter, uno para devolver el atributo (get) y el otro para modificarlo (set)
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

    //introducimos los getter y los setter, uno para devolver el atributo (get) y el otro para modificarlo (set)
    /**
     * @return mixed
     */
    public function getTlf()
    {
        return $this->tlf;
    }

    /**
     * @param mixed $tlf
     */
    public function setTlf($tlf)
    {
        $this->tlf = $tlf;
    }

    /**
     * Función que dado un nombre de una tienda nos devuelva su teléfono
     * @param string $nombre
     * @return string|null
     */
    public function getTelf($nombre)
    {
        //realizamos la consulta:
        $consulta = "SELECT tlf FROM tiendas WHERE nombre=:n";
        $stmt = self::$conexion->prepare($consulta); //prepara la consulta
        try {
            $stmt->execute([':n' => $nombre]);//sustituye los argumentos por los atributos (valores)
        } catch (\PDOException $ex) {
            die("Error al recuperar el teléfono: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return null;//en caso de que no haya ningún teléfono con esa tienda
        return ($stmt->fetch(PDO::FETCH_OBJ))->tlf;//si hay, devuelve el teléfono
    }


        
    

}