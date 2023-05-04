<?php
/**
 * La clase Stock hace relación a la tabla stocks de la base de datos, es decir, va a tener los atributos que correspondan
 * con los campos de la base de datos
 */

namespace Clases;

use \PDO;

require '../vendor/autoload.php';

class Stock extends Conexion
{
    //atributos accesibles sólo desde la clase
    private $producto;
    private $tienda;
    private $unidades;

    /**
     * Stock constructor. LLama al constructor padre, es decir, al constructor de Conexión
     */
    public function __construct()
    {
        parent::__construct();
    }

    //introducimos los getter y los setter, uno para devolver el atributo (get) y el otro para modificarlo (set)
    /**
     * @return mixed
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * @param mixed $producto
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;
    }

    /**
     * @return mixed
     */
    public function getTienda()
    {
        return $this->tienda;
    }

    /**
     * @param mixed $tienda
     */
    public function setTienda($tienda)
    {
        $this->tienda = $tienda;
    }

    /**
     * @return mixed
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * @param mixed $unidades
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    }
    
    /* Función que devuelve las unidades que tengan stock de un producto y tienda especificados
     * @param
     * @return int|null
     */
    public function getUnidadesTienda()
    {
        $consulta = "select unidades from stocks where producto=:p AND tienda=:t"; //realiza la consulta sql
        $stmt = self::$conexion->prepare($consulta); //prepara la consulta
        try {
            $stmt->execute([
                //sustituye los argumentos por los atributos (valores)
                ':p' => $this->producto, 
                ':t' => $this->tienda
            ]);
        } catch (\PDOException $ex) {
            die("Error al recuperar los unidades: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return 0;//en caso de que no haya ningún unidad con ese producto y tienda, devuelve 0
        return ($stmt->fetch(PDO::FETCH_OBJ))->unidades;//si hay, devuelve las unidades
    }
}
