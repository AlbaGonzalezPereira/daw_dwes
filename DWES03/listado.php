<?php
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
        <title>listado</title>
    </head>
    <body class="bg-info">
    <h3 class="text-center mt-2 font-weight-bold">Gestión de productos</h3>
    
        <div class="container mt-3">
        <a href="crear.php"><button type="button" class="btn btn-success mb-3">Crear</button></a>
        <table class="table table-dark table-striped text-center align-middle">
            <tr>
                <td>Detalle</td>
                <td>Código</td>
                <td>Nombre</td>
                <td>Acciones</td>
            </tr>

<?php
$resultado = $conProyecto->query("SELECT id,nombre FROM productos");
//recorremos los id y nombres de los productos con while
while ($registro = $resultado->fetch()) {
    //imprimimos la tabla como se pide
    echo "<tr>
    <td><a href='./detalle.php?id=".$registro['id']."'><button type='button' class='btn btn-info'>Detalle</button></a></td>
    <td>".$registro['id']."</td><td>".$registro['nombre']."</td>
    <td>
    <form action='borrar.php' method='post'>
    <a href='./update.php?id=".$registro['id']."'><button type='button' class='btn btn-warning'>Actualizar</button></a>
    <button type='submit' class='btn btn-danger'>Borrar</button>
    <input type='hidden' name='id' value='".$registro['id']."'/> 
    </form>
    
    </td>
    </tr>";
}

?>
</table>
</div>
<?php
//Cerramos la conexión
$conProyecto=null;
?>
</body>
</html>