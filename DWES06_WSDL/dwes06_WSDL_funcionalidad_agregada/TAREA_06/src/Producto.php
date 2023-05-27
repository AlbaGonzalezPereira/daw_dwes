<?php
/**
 * La clase Producto hace relación a la tabla Productos de la base de datos, es decir, va a tener los atributos que correspondan
 * con los campos de la base de datos
 */

namespace Clases;

require '../vendor/autoload.php';

use \PDO;

class Producto extends Conexion
{
    //atributos accesibles sólo desde la clase
    private $id;
    private $nombre;
    private $nombre_corto;
    private $pvp;
    private $famila;
    private $descripcion;

    /**
     * Producto constructor. LLama al constructor padre, es decir, al constructor de Conexión
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
     * @return mixed
     */
    public function getNombreCorto()
    {
        return $this->nombre_corto;
    }

    /**
     * @param mixed $nombre_corto
     */
    public function setNombreCorto($nombre_corto)
    {
        $this->nombre_corto = $nombre_corto;
    }

    /**
     * @return mixed
     */
    public function getPvp()
    {
        return $this->pvp;
    }

    /**
     * @param mixed $pvp
     */
    public function setPvp($pvp)
    {
        $this->pvp = $pvp;
    }

    /**
     * @return mixed
     */
    public function getFamila()
    {
        return $this->famila;
    }

    /**
     * @param mixed $famila
     */
    public function setFamila($famila)
    {
        $this->famila = $famila;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /*
     * @param string $codF
     * @return array|null
     */
    public function productoFamila($codF)
    {
        //función que nos devolverá los nombres de los productos cuya familia corresponda con el código de la familia que se haya introducido
        $consulta = "select nombre from productos where familia=:f";//creamos la variable consulta con la consulta sql que queremos realizar
        $stmt = self::$conexion->prepare($consulta); //prepara la consulta
        try {
            $stmt->execute([':f' => $codF]);
        } catch (\PDOException $ex) {//en caso de error lanza una excepción
            die("Error al recuperar los productos x famila: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return null;//si es igual a 0 devuelve null
        while ($fila = $stmt->fetch(PDO::FETCH_OBJ)) {//recorre cada uno de los nombres y los guarda en un array
            $productos[] = $fila->nombre;//los guarda en $productos[]
        }
        return $productos;//devuelve el array
    }

    /*
     * @param
     * @return float|null
     */
    public function getPrecio()
    {
        $consulta = "select pvp from productos where id=:i"; //creamos variable con la consulta que nos devolverá el precio a partir del id de un producto
        $stmt = self::$conexion->prepare($consulta);
        try {
            $stmt->execute([':i' => $this->id]);//ejecuta la conexión, sustituyendo en la consulta el valor por el atributo
        } catch (\PDOException $ex) {
            die("Error al recuperar los productos x famila: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return null;
        return ($stmt->fetch(PDO::FETCH_OBJ))->pvp;//va a devolver uno
    }

    /**
     * @param string $codT
     * @return float|null
     */
    public function getMontante($codT){
        $consulta = "select sum(stocks.unidades*productos.pvp) AS montante FROM stocks,productos WHERE stocks.producto=productos.id and stocks.tienda = :i";
        $stmt = self::$conexion->prepare($consulta);
        try {
            $stmt->execute([':i' => $codT]);//ejecuta la conexión, sustituyendo en la consulta el valor por el atributo
        } catch (\PDOException $ex) {
            die("Error al recuperar el montante: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return null;
        return ($stmt->fetch(PDO::FETCH_OBJ))->montante;
        //return ($stmt->fetch(PDO::FETCH_OBJ));--> es lo mismo que la anterior pero así no tenemos que poner montante en Operaciones.php
    }
}
