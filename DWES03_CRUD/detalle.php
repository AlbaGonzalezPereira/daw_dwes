<?php

if (!isset ($_GET['id'])){
    header('Location:listado.php');
}
else{
    $cod=$_GET['id'];
}
//añadimos el archivo de conexión para conectar la bbdd
include 'conexion.php';


?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- css para usar Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <title>Detalle</title>
    </head>
    <body class="bg-info">
    <h3 class="text-center mt-2 font-weight-bold text-light">Detalle Producto</h3>
    
        <div class="container mt-3 w-50">
        <div class="bg-info-subtle bg-opacity-10 border border-dark-subtle rounded bg-dark-subtle text-light">
            
            <div class="border-bottom border border-dark-subtle text-center pt-3">
            <?php
            $resultado = $conProyecto->query("SELECT nombre FROM productos WHERE id=$cod");//nombre, nombre_corto,  descripcion, pvp, familia
            while ($consulta = $resultado->fetch()) {
                echo"<p>$consulta[nombre]</p>";
            }
            ?>
            </div>
            <div class="px-4"><p><h5 class="text-center">Codigo: <?php echo $cod; ?></h5></p>
            <?php
            $resultado = $conProyecto->query("SELECT nombre, nombre_corto,  descripcion, pvp, familia FROM productos WHERE id=$cod");//nombre, nombre_corto,  descripcion, pvp, familia
            while ($consulta = $resultado->fetch()) {
                echo"<p><b>Nombre:</b> $consulta[nombre]</p>";
                echo"<p><b>Nombre corto:</b> $consulta[nombre_corto]</p>";
                echo"<p><b>Descripción:</b> $consulta[descripcion]</p>";
                echo"<p><b>PVP(€):</b> $consulta[pvp]</p>";
                echo"<p><b>Familia:</b> $consulta[familia]</p>";
            }
            ?>
        </div>
        
        </div>
        <div class="col v-center">
        <a href="listado.php"><button class="btn btn-primary me-3 mt-3 mx-auto" name="volver">Volver</button></a>
        </div>
</div>
<?php
//Cerramos la conexión
$conProyecto=null;
?>
</body>
</html>