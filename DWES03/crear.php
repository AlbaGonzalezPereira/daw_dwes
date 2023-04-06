
<?php
//añadimos el archivo de conexión para conectar la bbdd
include 'conexion.php';
?>

<?php
/* Comprobamos que tiene algo $_POST y le dimos a crear
if (isset ($_POST['crear'])){
    var_dump($_POST);
}*/

//si se le da a crear (enviar)
if (isset ($_POST['crear'])){
   // Definimos la variable para comprobar ejecución.
   //$isOk = true;
   try {
   // Iniciamos la transacción
  // $conProyecto->beginTransaction();
   $insert = $conProyecto->prepare("insert into productos (nombre, nombre_corto,  descripcion, pvp, familia) values (:nombre,:nombrec,:descripcion,:precio,:familia)"); //el id lo genera automáticamente
   
   //para añadir los valores de la sentencia precompilada a la base de datos
   $insert->bindParam(':nombre', $_POST['nombre']); 
   $insert->bindParam(':nombrec', $_POST['nombrec']);
   $insert->bindParam(':descripcion', $_POST['descripcion']);  
   $insert->bindParam(':precio', $_POST['precio']); 
   $insert->bindParam(':familia', $_POST['familia']); 
   
   $insert->execute();
   echo "Los cambios se realizaron correctamente";
} catch(PDOException $e) {
  echo "No se han podido realizar los cambios: " . $e->getMessage();
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
    <title>crear</title>
</head>

<body class="bg-info">
    <h3 class="text-center mt-2 font-weight-bold">Crear producto</h3>
    <div class="container mt-3 w-75">
        <form method="post">
            <div class="row g-3 align-items-center">
                <div class="mb-3 col-6">
                  <label for="name" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="name" name="nombre" placeholder="Nombre">
                </div>
                <div class="mb-3 col-6">
                  <label for="namec" class="form-label">Nombre corto</label>
                  <input type="text" class="form-control" id="namec" name="nombrec" placeholder="Nombre corto">
                </div>
                <div class="mb-3 col-6">
                  <label for="precio" class="form-label">Precio (€)</label>
                  <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio (€)">
                </div>
                <div class="mb-3 col-6">
                  <label for="familia" class="form-label">Familia</label>
                  <select class="form-select" aria-label="Default select example" name="familia" id="familia">
                  <?php
                    $resultado = $conProyecto->query("SELECT cod,nombre FROM familias");
                    //recorremos los id y nombres de los productos con while
                    while ($familia = $resultado->fetch()) {
                        //imprimimos la tabla como se pide
                        echo "<option value=".$familia['cod'].">".$familia['nombre']."</option>";
                    }
                  ?>
                </select>
                </div>
            
                <div class="mb-3 col-9">
                    <label for="texto" class="form-label">Descripción</label>
                      <textarea class="form-control" placeholder="" id="texto" name="descripcion" style="height: 300px"></textarea>
                </div>

            </div>
            <button type="submit" class="btn btn-primary me-3" name="crear">Crear</button>
            <a href="./crear.php"><button type="button" class="btn btn-success me-3">Limpiar</button></a>
            <a href="./listado.php"><button type="button" class="btn btn-secondary">Volver</button></a>
        </form>
    </div>

    <?php
    //Cerramos la conexión
    $conProyecto=null;
    ?>
</body>
</html>