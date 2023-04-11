<?php

namespace Clases;

use PDO;
use PDOException;

/**
 * Clase Jugarores que hereda de Conexion y los va a gestionar con la base de datos
 */
class Jugadores extends Conexion{
    //ponemos los mismos atributos que los campos de la base de datos
    private $id;
    private $nombre;
    private $apellidos;
    private $dorsal;
    private $posicion;
    private $barcode;

    /**
     * Constructor que va a llamar al contructor padre, es decir, al constructor de Conexion
     */
    public function __construct(){
        parent::__construct(); //para llamar al constructor padre
    }

    /**
     * método que va a devolver todos los jugadores
     */
    public function recuperarJugadores(){
        $consulta="select * from jugadores order by posicion, apellidos"; //hacemos una consulta y los ordena por posicion y apellidos de forma ascendente
        $stmt    = $this->conexion->prepare($consulta); //variable stament, que nos prepara la consulta

        try {
            $stmt->execute(); //la ejecuta
        } catch (PDOException $ex) { //si hay un error nos va al catch
            die("Error al mostrar los jugadores: ".$ex->getMessage());
        }
        $this->conexion=null; //cierra la conexión
        return $stmt->fetchAll(PDO::FETCH_OBJ); //fetchAll() --> método que devuelve todo en forma de objetos
    }

    /**
     * método que dice si existe ese dorsal. Devuelve true o false
     */
    public function existeDorsal($d){
        $consulta="select * from jugadores where dorsal=:d"; //nos hace la consulta con el select
        //:d --> prepara la consulta preparada
        $stmt    = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([':d' => $d]); //sustituye :d por el parámetro del dorsal
        } catch (PDOException $ex) {
            die("Error al comprobar el dorsal: ".$ex->getMessage());
        }
        if ($stmt->rowCount()==0) { //no encontró el dorsal
            return false;
        }
        else {//lo encontró
            return true;
        }
    }

    /**
     * método que te busca un barcode y si existe te devuelve true y sino false
     * Similar al método anterior
     */
    public function existeBarcode($b){
        $consulta="select * from jugadores where barcode=:b";
        $stmt    = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([':b' => $b]);
        } catch (PDOException $ex) {
            die("Error al comprobar el código de barras: ".$ex->getMessage());
        }
        if ($stmt->rowCount()==0) {
            return false;
        }
        else {
            return true;
        }
    }

    /**
     * método para crear jugadores seleccionando los campos e insertando valores
     */
    public function create(){
        $insert="insert into jugadores(nombre, apellidos, dorsal, posicion, barcode) values(:n, :a, :d, :p, :b)";
        $stmt    = $this->conexion->prepare($insert);//prepara la consulta
        try { //coge los atributos de la clase y los sustituye en el insert, por los valores correspondientes que tengan
            $stmt->execute([':n' => $this->nombre,
                            ':a' => $this->apellidos,
                            ':d' => $this->dorsal,
                            ':p' => $this->posicion,
                            ':b' => $this->barcode]);
        } catch (PDOException $ex) {
            die("Error al insertar los jugadores: ".$ex->getMessage());//si da error mostrará el mensaje
        }
    }

    /**
     * método para borrar todos los jugadores de la base de datso
     */
    public function borrarTodo(){
        $insert="delete from jugadores";//los borra
        $stmt    = $this->conexion->prepare($insert);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al borrar los jugadores: ".$ex->getMessage());
        }
    }

    /**
     * método para comprobar si hay datos en la base de datos
     */
    public function tieneDatos(){
        $consulta="select * from jugadores";
        $stmt    = $this->conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al comprobar si hay datos: ".$ex->getMessage());
        }
        if ($stmt->rowCount()==0) {//no encontró ninguna fila--> no hay jugadores
            return false;
        }
        else {
            return true;//encontró jugadores
        }
    }

    //insertamos los setters de los atributos, que sirven para modificar los datos

    public function setId($id){
        $this->id = $id;  
    }

    
    public function setNombre($nombre) {
        $this->nombre = $nombre;  
    }

    
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;  
    }

    
    public function setDorsal($dorsal){
        $this->dorsal = $dorsal;  
    }

     
    public function setPosicion($posicion) {
        $this->posicion = $posicion;  
    }

    
    public function setBarcode($barcode){
        $this->barcode = $barcode;  
    }
}