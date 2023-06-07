<?php

//require '../conexion.php';
//require(__DIR__ . '../vendor/autoload.php');

require (__DIR__ . './vendor/autoload.php');
require (__DIR__ . './conexion.php');

//require(__DIR__ . './conexion.php');

class Palindromo
{
    //insertamos las variables de la tabla palindromos
    private $id;
    private $usuario;
    private $frase;
    private $esPalindromo;
    

    /**
     * Palindromo constructor
     */
    public function __construct() {
        // parent::__construct();
    }

    //introducimos los setter, para modificar los atributos
    public function setUsuario($u) {
        $this->usuario = $u;
    }

    public function setFrase($f)  {
        $this->frase = $f;
    }

    public function setEsPalindromo($p)  {
        $this->esPalindromo = $p;
    }

    /**
     * Función que inserta un nuevo registro en la tabla palindromos de la base de datos
     */
    public function insertar() {
        $sql = "insert into palindromos(usuario, frase, esPalindromo) values(:u, :f, :p)";
        $stmt = $conProyecto->prepare($sql);

        try {
            $stmt->execute(['u' => $this->usuario, 
                            'f' => $this->frase, 
                            'p' =>$this->esPalindromo]);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

        $conProyecto = null; //cerramos la conexión. Es la variable de conexion.php
    }

    // /**
    //  * Función que valida un usuario y una contraseña
    //  * @param $u,$p - usuario y contraseña
    //  * @return - true/false si es válido o no
    //  */
    // public function isValido($u, $p)  {
    //     $pass1 = hash('sha256', $p); //utiliza el algoritmo de hash SHA-256 para encriptar la contraseña
    //     $consulta = "select * from usuarios where usuario=:u AND pass=:p";//declara la consulta
    //     $stmt = Conexion::$conexion->prepare($consulta);//prepara la consulta con la conexión
    //     try {
    //         $stmt->execute([
    //             ':u' => $u,
    //             ':p' => $pass1
    //         ]);
    //     } catch (PDOException $ex) {
    //         die("Error al consultar usuario: " . $ex->getMessage());
    //     }
    //     $filas = $stmt->rowCount();//cuenta el número de registros devueltos que va a guardar en la variable $filas
    //     if ($filas == 0) return false;//no encontró ningún usuario
    //     return true;
    // }

    // /**
    //  * Función que nos dice si un usuario existe en la tabla usuarios
    //  * @return - true si existe, false en caso contrario
    //  */
    // public function existe($u)  {
    //     $c = "select * from usuarios where usuario=:u";
    //     $stmt = Conexion::$conexion->prepare($c);
    //     $stmt->execute([':u' => $u]);
    //     $filas = $stmt->rowCount();
    //     if ($filas == 0) return false;
    //     return true;
    // }

    // /****************************FUNCIONALIDAD AÑADIDA*************************** */
    // /**
    //  * Función que elimina un usuario de la tabla usuarios
    //  * @param $usuario - nombre de usuario 
    //  * @return - true si se eliminó correctamente, false en caso contrario
    //  */
    // public function eliminarUsuario($u){
    //     $consulta = "DELETE FROM usuarios WHERE usuario = :u";
    //     $stmt = Conexion::$conexion->prepare($consulta);

    //     try {
    //         $stmt->execute([':u' => $u]);
    //         return true;
    //     } catch (PDOException $ex) {
    //         die("Error al eliminar el usuario: " . $ex->getMessage());
    //     }
    // }
}
