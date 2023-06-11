<?php

// require 'Conexion.php';
/**
 * La clase Usuario hace relación a la tabla Usuarios de la base de datos, es decir, va a tener los atributos que correspondan
 * con los campos de la base de datos
 */
class Usuario extends Conexion
{
    private $usuario;
    private $pass;

    /**
     * Usuario constructor. LLama al constructor padre, es decir, al constructor de Conexion
     */
    public function __construct() {
        parent::__construct();
    }

    //introducimos los getter y los setter, uno para devolver el atributo (get) y el otro para modificarlo (set)
    public function setUsuario($u) {
        $this->usuario = $u;
    }

    public function setPass($p)  {
        $this->pass = $p;
    }

    /**
     * Función que inserta un nuevo registro en la tabla de usuarios de una base de datos, utilizando la función SHA2 de MySQL para encriptar la contraseña
     */
    public function create() {
        $i = "insert into usuarios(usuario, pass) select :u, sha2(:p, '256')";
        $stmt = Conexion::$conexion->prepare($i);

        try {
            $stmt->execute(['u' => $this->usuario, 'p' => $this->pass]);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    /**
     * Función que valida un usuario y una contraseña
     * @param $u,$p - usuario y contraseña
     * @return - true/false si es válido o no
     */
    public function isValido($u, $p)  {
        $pass1 = hash('sha256', $p); //utiliza el algoritmo de hash SHA-256 para encriptar la contraseña
        $consulta = "select * from usuarios where usuario=:u AND pass=:p";//declara la consulta
        $stmt = Conexion::$conexion->prepare($consulta);//prepara la consulta con la conexión
        try {
            $stmt->execute([
                ':u' => $u,
                ':p' => $pass1
            ]);
        } catch (PDOException $ex) {
            die("Error al consultar usuario: " . $ex->getMessage());
        }
        $filas = $stmt->rowCount();//cuenta el número de registros devueltos que va a guardar en la variable $filas
        if ($filas == 0) return false;//no encontró ningún usuario
        return true;
    }

    /**
     * Función que nos dice si un usuario existe en la tabla usuarios
     * @return - true si existe, false en caso contrario
     */
    public function existe($u)  {
        $c = "select * from usuarios where usuario=:u";
        $stmt = Conexion::$conexion->prepare($c);
        $stmt->execute([':u' => $u]);
        $filas = $stmt->rowCount();
        if ($filas == 0) return false;
        return true;
    }

    /****************************FUNCIONALIDAD AÑADIDA*************************** */
    /**
     * Función que elimina un usuario de la tabla usuarios
     * @param $usuario - nombre de usuario 
     * @return - true si se eliminó correctamente, false en caso contrario
     */
    public function eliminarUsuario($u){
        $consulta = "DELETE FROM usuarios WHERE usuario = :u";
        $stmt = Conexion::$conexion->prepare($consulta);

        try {
            $stmt->execute([':u' => $u]);
            return true;
        } catch (PDOException $ex) {
            die("Error al eliminar el usuario: " . $ex->getMessage());
        }
    }
}
