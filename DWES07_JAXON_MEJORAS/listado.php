<?php
// [JAXON-PHP]

session_start();//para indicar que se va a usar una sesión

//si no está definida la sesión vuelve a login.php
if (!isset($_SESSION['usu'])) {
    header('Location:login.php');
    die();//detenemos el script
}

$usu = $_SESSION['usu'];//guarda en la variable $usu lo que haya en $_SESSION['usu']
spl_autoload_register(function ($clase) {
    include "./include/" . $clase . ".php";
});


$productos = new Producto();//crea una conexión mediante la tabla productos
$todos     = $productos->listadoProductosTienda($_SESSION['idT']); //guarda en $todos el listado que devuelva la función listadoProductos()
$productos = null;

/**
 * función que pinta las estrellas en un producto
 * @param - $p -id de un producto
 * @return - $estrellas - cadena con el html de las estrellas a pintar
 */
function pintarEstrellasPagina($p)  {
    $votos     = new Voto();//crea una conexión con Voto
    $c         = $votos->getMedia($p);//contiene la media de la cantidad de estrellas votadas en un producto
    $en        = intval($c);
    $dec       = $c - $en;
    $estrellas = "{$votos->getTotalVotos($p)} Valoraciones. ";

    //pintamos las estrellas, las medias estrellas y en caso de que no haya estrellas ponemos sin valorar
    if ($en > 0) {
        for ($i = 1; $i <= $en; $i++) {
            $estrellas .= "<i class='fas fa-star'></i>";
        }

        if ($dec >= 0.5)
            $estrellas .= "<i class='fas fa-star-half-alt'></i>";
    } else {
        $estrellas = "Sin valorar";
    }

    $votos = null;//cerramos la conexión
    return $estrellas;//devolvemos estrellas
}

// Preparamos Jaxon:
require (__DIR__ . '/include/Votar.php');

use function Jaxon\jaxon;

// Procesar la solicitud
if($jaxon->canProcessRequest())  $jaxon->processRequest();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Productos</title>
    <script type="text/javascript" src="votar.js"></script>
</head>

<body style="background:#00bfa5;">
    <div class="float float-right d-inline-flex mt-2">
        <i class="fas fa-user mr-3 fa-2x"></i>
        <input type="text" size='10px' value="<?php echo $usu; ?>" class="form-control mr-2 bg-transparent text-white font-weight-bold" disabled>
        <!--sacar los votos de un usuario al darle al botón-->
        <?php echo "<button class=\"btn btn-warning mr-2\" onClick=\"jaxon_misVotos('{$usu}');return false;\">Mis votos</button>";?>
        <a href="crear.php" class="btn btn-warning mr-2">Crear</a>
        <a href="cerrar.php" class="btn btn-warning mr-2">Salir</a>
        
    </div>
    <br>
    <h4 class="container text-center mt-4 font-weight-bold">Productos onLine</h4>
    <div id="votos"></div>
    <div class="container mt-3">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col" class='text-center'>Código</th>
                    <th scope="col" class='text-center'>Nombre</th>
                    <th scope="col" class='text-center'>Valoración</th>
                    <th scpope="col" colspan="2" class='text-center'>Valorar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                while ($item = $todos->fetch(PDO::FETCH_OBJ)) {
                    echo "<tr class='text-center'>\n";
                    echo "<th scope='row'>{$item->id}</th>\n";
                    echo "<td>{$item->nombre}</td>\n";
                    echo "<td><div id='votos_{$item->id}' class='float-left'>";
                    echo pintarEstrellasPagina($item->id);
                    echo "</div> </td>\n";
                    echo "<td><select name='puntos' class='form-control' id='spuntos_{$item->id}'>";
                    for ($i = 1; $i <= 5; $i++) {
                        echo "<option>$i</option>\n";
                    }
                    echo "</select>\n";
                    echo "</td><td>";
                    //echo "<button class='btn btn-info' onclick=\"envVoto('{$usu}','{$item->id}')\">Votar</button>";
                    //creamos un botón que nos permitirá borrar el voto y hacer reecuento de las estrellas. AÑADIDO
                    //echo "<button class='btn btn-danger mx-4' onclick=\"borrarVoto('{$usu}','{$item->id}')\">Cambiar</button>";
                    //si el usuario ya votó un producto, que aparezca un botón: "Cambiar" que le permita modificar su voto para ese producto
                    $voto = new Voto();
                    $puede = $voto->puedeVotar($usu, $item->id);
                    $voto = null;
                    if(!$puede){
                        echo "<button class='btn btn-danger mx-4' onclick=\"borrarVoto('{$usu}','{$item->id}')\">Cambiar</button>";
                    }
                        echo "<button class='btn btn-info' onclick=\"envVoto('{$usu}','{$item->id}')\">Votar</button>";
                    
                    echo "</td>\n";
                    echo "</tr>\n";
                }
                ?>
            </tbody>
        </table>
</body>
<?php
$jaxon = jaxon();
echo $jaxon->getCss(), "\n", $jaxon->getJs(), "\n", $jaxon->getScript(), "\n";
echo "<!-- HTTP comment  -->\n"
?>
</html>
