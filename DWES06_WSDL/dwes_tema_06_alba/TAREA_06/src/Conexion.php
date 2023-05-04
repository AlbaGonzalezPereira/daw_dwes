<?php
//es la clase para conectarnos a una base de datos
namespace Clases;

//importamos las clases PDO y PDOException
use PDO;//permite conectarnos a bases de datos y ejecutar consultas SQL
use PDOException;//lanza una excepción si se produzca un error en la conexión o en la ejecución de consultas

class Conexion
{
    protected static $conexion;//es protected para que se puede acceder desde las clases que heredan de Conexión


    /**
     * Declaramos el constructor, que crea la conexión si no existe previamente, en caso contrario no hace nada
     */
    public function __construct()
    {
        if (self::$conexion == null) {
            self::crearConexion();
        }
    }

    /**
     * Función que nos crea una conexión con un usuario, contraseña, base de datos y la cadena de conexión dados
     */
    public static function crearConexion(){
        //ponemos usuario, contraseña, base de datos
        $user = "gestor";
        $pass = "secreto";
        $base='tarea6';
        $dsn = "mysql:host=localhost;dbname=$base;charset=utf8mb4"; //cadena de conexión para conectarse a la bbdd
        
        try {
            self::$conexion = new PDO($dsn, $user, $pass);//establece la conexión con los parámetros cadena de conexión, usuario y contraseña
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //lanza una excepción en caso de un error
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage());
        }
    }
}

