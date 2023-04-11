<?php
//añadimos el archivo de conexión para conectar la bbdd

if (!isset ($_GET['id'])){
    header('Location:listado.php'); //te redirige a la página si no encuentra el id
}
else{
    $cod=$_GET['id']; //nos piden los datos por url, por eso utilizamos $_GET
}
include 'conexion.php';
?>

<?php
            // Definimos la variable para comprobar ejecución.
            if(isset($_GET['modificar'])){
            $isOk = true;
            
            // Iniciamos la transacción
            $conProyecto->beginTransaction();
            $update = "update productos set nombre=\"".$_GET['nombre']."\", nombre_corto=\"".$_GET['nombrec']."\", descripcion=\"".$_GET['descripcion']."\", pvp=".$_GET['precio'].", familia=\"".$_GET['familia']."\" where id=$cod";
            echo $update;
            if ( !$conProyecto->exec($update) ) $isOk = false;
           
          
            // Si fue bien, confirmamos los cambios
            // y en caso contrario los deshacemos
            if ($isOk) {
                $conProyecto->commit();
                echo "<p class='text-primary font-weight-bold'>Los cambios se realizaron correctamente.</p>";
            } else {
                $conProyecto->rollBack();
                echo "<p class='text-danger font-weight-bold'>No se han podido realizar los cambios.</p>";
            }

        }
            ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css para usar Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Modificar</title>
</head>

<body class="bg-info">
    <h3 class="text-center mt-2 font-weight-bold">Modificar producto</h3>
    <div class="container mt-3 w-75">
        <form action="update.php" method="get">
            <div class="row g-3 align-items-center">
            <?php
                     $resultado = $conProyecto->query("SELECT nombre, nombre_corto, descripcion, pvp, familia FROM productos WHERE id=$cod");
                     while ($dato = $resultado->fetch()) {
                            //imprimimos la tabla como se pide
                            
                        
            ?>
                <div class="mb-3 col-6">
                  <label for="name" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="name" name="nombre" value="<?php echo $dato['nombre'];?>">
                </div>
                <div class="mb-3 col-6">
                  <label for="namec" class="form-label">Nombre corto</label>
                  <input type="text" class="form-control" id="namec" name="nombrec" value="<?php echo $dato['nombre_corto'];?>">
                </div>
                <div class="mb-3 col-6">
                  <label for="precio" class="form-label">Precio (€)</label>
                  <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $dato['pvp'];?>">
                </div>
                <div class="mb-3 col-6">
                  <label for="familia" class="form-label">Familia</label>
                  <select class="form-select" aria-label="Default select example" name="familia" id="familia">
                  <?php
                    
                    $resultado = $conProyecto->query("SELECT cod,nombre FROM familias");
                    
                    //recorremos los id y nombres de los productos con while
                    while ($familia = $resultado->fetch()) {
                        //imprimimos la tabla como se pide
                        if($familia['cod'] == $dato['familia']){
                        echo "<option selected value=".$familia['cod'].">".$familia['nombre']."</option>";
                    }else{
                        echo "<option value=".$familia['cod'].">".$familia['nombre']."</option>";
                    }
                }
                  
                  ?>
                </select>
                </div> 
            
                <div class="mb-3 col-9">
                    <label for="texto" class="form-label">Descripción</label>
                      <textarea class="form-control" placeholder="" id="texto" name="descripcion" style="height: 300px"><?php echo $dato['descripcion'];?></textarea>
                </div>
                <?php }?>

            </div>
            <input type="hidden" name="id" value="<?php echo $cod;?>">
            <button type="submit" class="btn btn-primary me-3" name="modificar">Modificar</button>
            <a href="./listado.php"><button type="button" class="btn btn-secondary">Volver</button></a>

        
        </form>
    </div>

    <?php
    //Cerramos la conexión
    $conProyecto=null;
    ?>
</body>
</html>