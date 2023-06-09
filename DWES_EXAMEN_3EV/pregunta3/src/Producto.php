<?php
// EXAMEN 3º AVALIACION DWES


namespace Clases;

require '../vendor/autoload.php';

use \PDO;

class Producto extends Conexion
{
    private $id;
    private $nombre;
    private $nombre_corto;
    private $pvp;
    private $famila;
    private $descripcion;

    /**
     * Producto constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

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
        $consulta = "select nombre from productos where familia=:f";
        $stmt = self::$conexion->prepare($consulta);
        try {
            $stmt->execute([':f' => $codF]);
        } catch (\PDOException $ex) {
            die("Error al recuperar los productos x famila: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return null;
        while ($fila = $stmt->fetch(PDO::FETCH_OBJ)) {
            $productos[] = $fila->nombre;
        }
        return $productos;
    }
    
    /*
     * @param
     * @return float|null
     */
    public function getPrecio()
    {
        $consulta = "select pvp from productos where id=:i";
        $stmt = self::$conexion->prepare($consulta);
        try {
            $stmt->execute([':i' => $this->id]);
        } catch (\PDOException $ex) {
            die("Error al recuperar los productos x famila: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return null;
        return ($stmt->fetch(PDO::FETCH_OBJ))->pvp;
    }

    /***************************************PREGUNTA 3c.1****************************************** */
    //Creamos una función que me devuelva los id de todas las tiendas
    public function getAllIds(){
        $consulta ="SELECT id FROM productos ORDER BY id";
        $stmt = self::$conexion->prepare($consulta);
        try {
            $stmt->execute([]);
        } catch (\PDOException $ex) {
            die("Error al recuperar los ids: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return null;
        while ($fila = $stmt->fetch(PDO::FETCH_OBJ)) {
            $ids[] = $fila->id;
        }
        return $ids;//devolvemos un array con todos los ids
    }
}
