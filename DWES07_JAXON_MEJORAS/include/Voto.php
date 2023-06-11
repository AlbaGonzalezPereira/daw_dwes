<?php

//require 'Conexion.php';
class Voto extends Conexion {
    public $id;
    public $cantidad;
    public $idPr;
    public $idUs;

    /**
     * Constructor
     */
    public function __construc() {
        parent::__construct();
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad): void  {
        $this->cantidad = $cantidad;
    }

    /**
     * @param mixed $idPr
     */
    public function setIdPr($idPr): void {
        $this->idPr = $idPr;
    }

    /**
     * @param mixed $idUs
     */
    public function setIdUs($idUs): void {
        $this->idUs = $idUs;
    }

    /**
     * Función que inserta un voto de usuario en un producto
     */
    public function create() {
        $i = "insert into votos(cantidad, idPr, idUs) values(:c, :ip, :iu)";//consulta
        $stmt = self::$conexion->prepare($i);//prepara la consulta

        try {
            $stmt->execute([//ejecuta
                ':c'  => $this->cantidad,
                ':ip' => $this->idPr,
                ':iu' => $this->idUs
            ]);
        } catch (PDOException $ex) {
            die("Error al guardar voto: " . $ex->getMessage());//en caso de error, muestra el mensaje
        }
    }

    /**
     * Función que elimina el voto de un producto que ha hecho un usuario --> FUNCIÓN AÑADIDA
     */
    public function delete(){
        $i="delete from votos where idPr = :p and idUs = :iu";//consulta
        $stmt = self::$conexion->prepare($i);

        try {
            $stmt->execute([//ejecuta
                ':p'  => $this->idPr,
                ':iu' => $this->idUs
            ]);
        } catch (PDOException $ex) {
            die("Error al borrar voto: " . $ex->getMessage());//en caso de error, muestra el mensaje
        }

    }

    /**
     * Función que devuelve la suma total de todos los votos de un producto solicitado
     * @param $p - id del producto
     */
    public function getTotalPuntos($p) {
        $c    = "select sum(cantidad) as total from votos where idPr=:p";
        $stmt = Conexion::$conexion->prepare($c);

        $stmt->execute([':p' => $p]);
        return ($stmt->fetch(PDO::FETCH_OBJ))->total;
    }

    /**
     * Función que cuenta el número de veces que se ha votado de un producto solicitado
     * @param $p - id del producto
     * @return $total - número total de veces que han votado
     */
    public function getTotalVotos($p) {
        $c    = "select count(*) as total from votos where idPr=:p";
        $stmt = Conexion::$conexion->prepare($c);

        $stmt->execute([':p'=>$p]);
        return ($stmt->fetch(PDO::FETCH_OBJ))->total;
    }

    /**
     * Función que devuelve la media de la cantidad de votos de un producto solicitado
     * @param $p - id del producto
     * @return $media - media de la cantidad de estrellas
     */
    public function getMedia($p) {
        $c    = "select avg(cantidad) as media from votos where idPr=:p";
        $stmt = Conexion::$conexion->prepare($c);

        $stmt->execute([':p' => $p]);
        return ($stmt->fetch(PDO::FETCH_OBJ))->media;
    }

    /**
     * función que permite votar a un usuario por un producto si no lo ha votado antes
     * @param $u, $p - usuario y producto
     * @return - true/false - permite o no votar
     */
    public function puedeVotar($u, $p)  {
        $c    = "select * from votos where idPr=:p AND idUs=:u";
        $stmt = Conexion::$conexion->prepare($c);

        $stmt->execute([':p' => $p, ':u' => $u]);
        
        $filas = $stmt->rowCount();
        if ($filas == 0) return true;//si es verdadero permite votar
        return false;
    }
     /**
     * Función que nos devuelve el listado de los productos por tienda
     * @param - $id - id de la tienda
     */
    public function verVotos($idU)  {
        $consulta = "select productos.nombre,votos.cantidad from votos,productos where votos.idPr = productos.id and votos.idUs = :i";
        $stmt = self::$conexion->prepare($consulta); //ejecuta la consulta
        
        try {
            $stmt->execute([':i' =>$idU]);
        } catch (\PDOException $ex) {
            die("Error al recuperar los productos de la tienda" . $ex->getMessage());// muestra un mensaje de error
        }
        return $stmt;//devuelve la consulta preparada
    }
}
