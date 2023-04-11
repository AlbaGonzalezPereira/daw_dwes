<?php
//añadimos el archivo de conexión para conectar la bbdd
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css para usar Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>borrar</title>
</head>
<body>
<?php
            // Definimos la variable para comprobar ejecución.
            $isOk = true;
            $id=$_POST['id'];
            // Iniciamos la transacción 
            $conProyecto->beginTransaction();
            //DELETE FROM table_name WHERE condition;
            
            $delete = "DELETE FROM productos where id=$id";
            if ( !$conProyecto->exec($delete) ) $isOk = false;
            
          
            // Si fue bien, confirmamos los cambios
            // y en caso contrario los deshacemos
            if ($isOk) {
                $conProyecto->commit();
                echo "<span><b>Producto del Código: ".$id." Borrado correctamente</b></span>";

            //en este caso el else no es necesario porque no debería ejecutarse nunca. Lo dejo para tenerlo de plantilla    
            } else {
                $conProyecto->rollBack();
                echo "<p class='text-danger font-weight-bold'>No se han podido realizar los cambios.</p>";
            }

            //Cerramos la conexión.
            $conProyecto = null;
            ?>

<a href="listado.php"><button type="button" class="btn btn-light border border-dark-subtle rounded p-0 px-2">Volver</button></a>
</body>
</html>

