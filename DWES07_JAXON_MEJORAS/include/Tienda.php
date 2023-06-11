<?php

// require 'Conexion.php';
/**
 * La clase Usuario hace relación a la tabla Usuarios de la base de datos, es decir, va a tener los atributos que correspondan
 * con los campos de la base de datos
 */
class Tienda extends Conexion
{
    private $id;
    private $nombre;
    private $tlf;
    private $ciudad;

    /**
     * Usuario constructor. LLama al constructor padre, es decir, al constructor de Conexion
     */
    public function __construct() {
        parent::__construct();
    }

    //introducimos los getter y los setter, uno para devolver el atributo (get) y el otro para modificarlo (set)
    public function setId($i) {
        $this->id = $i;
    }

    public function setNombre($n)  {
        $this->nombre = $n;
    }

    public function setTlf($t)  {
        $this->tlf = $t;
    }

    public function setCiudad($c)  {
        $this->ciudad = $c;
    }

    public function getCiudades(){
        $consulta = "select id,ciudad from tiendas order by id";
        $stmt = Conexion::$conexion->prepare($consulta);

        try {
            $stmt->execute([]);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        
        if ($stmt->rowCount() == 0) return null;
        while ($fila = $stmt->fetch(PDO::FETCH_OBJ)) {
            $ciudades[] = [$fila->ciudad,$fila->id];
        }
        return $ciudades;//devolvemos un array con todas las ciudades

    }
    
}
