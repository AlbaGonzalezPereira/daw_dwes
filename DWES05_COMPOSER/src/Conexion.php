<?php

namespace Clases;

use PDO;
use PDOException;

class Conexion {//clase que nos permite conectarnos
    private $host;
    private $db;
    private $user;
    private $pass;
    private $dsn;
    protected $conexion; //método protected que puede ser accesible desde las clases heredadas

    public function __construct() {//constructor
        $this->host = "localhost";
        $this->db = "practicaunidad5";//base de datos
        $this->user = "gestor";//usuario
        $this->pass = "secreto";//contraseña
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
        $this->crearConexion(); //llama al método crearConexion()
    }

    public function crearConexion() {//método crearConexion() que nos crea la conexión
        try {
            $this->conexion = new PDO($this->dsn, $this->user, $this->pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage()); //si hay un error lo muestra
        }
        return $this->conexion;
    }
}//fin clase