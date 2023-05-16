<?php
//require 'Conexion.php';
/**
 * La clase Producto hace relación a la tabla Productos de la base de datos, es decir, va a tener los atributos que correspondan
 * con los campos de la base de datos
 */
class Producto extends Conexion  {
    //declaramos los atributos:
    private $id;
    private $nombre;
    private $nombre_corto;
    private $pvp;
    private $famila;
    private $descripcion;

    /**
     * Producto constructor. LLama al constructor padre, es decir, al constructor de Conexion
     */
    public function __construct()  {
        parent::__construct();
    }

    //introducimos los getter y los setter, uno para devolver el atributo (get) y el otro para modificarlo (set)
    /**
     * @return mixed
     */
    public function getId()  {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)  {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getNombreCorto() {
        return $this->nombre_corto;
    }

    /**
     * @param mixed $nombre_corto
     */
    public function setNombreCorto($nombre_corto) {
        $this->nombre_corto = $nombre_corto;
    }

    /**
     * @return mixed
     */
    public function getPvp() {
        return $this->pvp;
    }

    /**
     * @param mixed $pvp
     */
    public function setPvp($pvp) {
        $this->pvp = $pvp;
    }

    /**
     * @return mixed
     */
    public function getFamila() {
        return $this->famila;
    }

    /**
     * @param mixed $famila
     */
    public function setFamila($famila)  {
        $this->famila = $famila;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()  {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    /*
     * método que selecciona todos los registros de la tabla "productos" y los ordena por el campo "id".
     * @return $stmt
     */
    public function listadoProductos()  {
        $consulta = "select * from productos order by id";
        $stmt = self::$conexion->prepare($consulta); //ejecuta la consulta
        
        try {
            $stmt->execute();
        } catch (\PDOException $ex) {
            die("Error al recuperar los productos" . $ex->getMessage());// muestra un mensaje de error
        }
        return $stmt;//devuelve la consulta preparada
    }


    /***********************************FUNCIONALIDAD AÑADIDA***************************************** */
    /**
     * función que inserta datos en la tabla productos 
     * @param - $datos - datos a insertar en la consulta
     */
    public function insertarProductos($datos){
        $consulta = "INSERT INTO productos (nombre, nombre_corto, pvp, familia, descripcion) VALUES (:n, :nc, :p, :f, :d)";
        $stmt = self::$conexion->prepare($consulta);

        try {
            $stmt->execute([
                ':n' =>$this->datos['nombre'],
                ':nc'=>$this->datos['nombre_corto'],
                ':p' =>$this->datos['pvp'],
                ':f' =>$this->datos['familia'],
                ':s' =>$this->datos['descripcion']
                ]);
            echo "Los datos se han insertado correctamente.";
        } catch (\PDOException $ex) {//si da error
            die("Error al insertar el producto: " . $ex->getMessage());
        }
    }

}
