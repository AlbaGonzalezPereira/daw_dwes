<?php
//Clase que se encarga de establecer y crea una conexión a una base de datos utilizando PDO 

class Conexion
{
    protected static $conexion;


    public function __construct()
    {
        if (self::$conexion == null) {//si la conexión no ha sido establecida, la crea
            self::crearConexion();
        }
    }

    /**
     * Función que establece la conexión a la base de datos utilizando PDO
     */
    public static function crearConexion()
    {
        $user = "gestor";
        $pass = "secreto";
        $base = 'proyecto';
        $dsn  = "mysql:host=localhost;dbname=$base;charset=utf8mb4";

        try {
            self::$conexion = new PDO($dsn, $user, $pass);//crea una conexión a la base de datos
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage());
        }
    }
}
