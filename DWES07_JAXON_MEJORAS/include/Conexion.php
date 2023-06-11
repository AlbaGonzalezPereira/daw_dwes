<?php

/**
 * clase para conectarnos a una base de datos
 */
class Conexion
{
    protected static $conexion;

    /**
     * Constructor, que crea la conexión si no existe previamente, en caso contrario no hace nada
     */
    public function __construct()  {
        if (self::$conexion == null) { //si es nula nos crea la conexión
            self::crearConexion();
        }
    }

    /**
     * función que nos va a crear la conexión a una base de datos, en este caso a la de tarea7, con un usuario, contraseña, base de datos y la cadena de conexión dados
     */
    public static function crearConexion()  {
        $user = "gestor";
        $pass = "secreto";
        $base = 'tarea7';
        $dsn  = "mysql:host=localhost;dbname=$base;charset=utf8mb4";

        try {
            self::$conexion = new PDO($dsn, $user, $pass); //establece la conexión con los parámetros cadena de conexión, usuario y contraseña
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//lanza una excepción en caso de un error
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage());
        }
    }
}
