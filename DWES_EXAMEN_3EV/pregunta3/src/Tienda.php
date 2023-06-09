<?php
namespace Clases;

use \PDO;

require '../vendor/autoload.php';

class Tienda extends Conexion
{
    private $id;
    private $nombre;
    private $tlf;
    private $ciudad;

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
     * 
     */
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * @param mixed $id
     */
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getTlf(){
        return $this->tlf;
    }

    public function setTlf($tlf){
        $this->tlf = $tlf;
    }

    public function getCiudad(){
        return $this->ciudad;
    }
    public function setCiudad($ciudad){
        $this->ciudad = $ciudad;
    }

    /*************************************PREGUNTA 3b)******************************************* */
    //Añade al servicio SOAP una nueva función que permita obtener la ciudad de una tienda dada. 
    public function getCiudadTienda($id){
        $consulta = "SELECT ciudad FROM tiendas WHERE id = :i";
        $stmt = self::$conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':i' => $id
            ]);
        } catch (\PDOException $ex) {
            die("Error al recuperar la ciudad: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return null;
        return ($stmt->fetch(PDO::FETCH_OBJ))->ciudad;
    }


    /***************************************PREGUNTA 3c.1****************************************** */
    //Creamos una función que me devuelva los id de todas las tiendas
    public function getAllIds(){
        $consulta ="SELECT id FROM tiendas";
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

?>