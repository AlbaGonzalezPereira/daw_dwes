<?php
$host = "localhost";
$db = "pregunta2";
$user = "adminpregunta2";
$pass = "secreto";
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
    $conProyecto = new PDO($dsn, $user, $pass);
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Error en la conexión: mensaje: " . $ex->getMessage());
}
// function consultarProducto($id)
// {
//     global $conProyecto;
//     $consulta = "select * from productos where id=:i";
//     $stmt1 = $conProyecto->prepare($consulta);
//     try {
//         $stmt1->execute([':i' => $id]);
//     } catch (PDOException $ex) {
//         die("Error al recuperar Productos: " . $ex->getMessage());
//     }
//     //esta consulta solo devuelve una fila es innecesario el while para recorrerla
//     $producto = $stmt1->fetch(PDO::FETCH_OBJ);
//     $stmt1 = null;
//     return $producto;

// }

/**
 * Función que cierra la conexión (se pasa por referencia, se puede cerrar desde cualquier sitio)
 */
function cerrar(&$con){
    $con = null;
}

/**
 * Función para cerrar la conexión y la consulta (se pasa por referencia)
 */
function cerrarTodo(&$con, &$st){
    $st = null;
    $con = null;
}