<?php
session_start();

/*****************************Pregunta 3d**************************** */
//1.- Incluimos las librerias Jaxon
//require(__DIR__ . '/vendor/autoload.php');
require '../vendor/autoload.php';

use Clases\Clases1\ClasesOperacionesService;
use Clases\Temperatura;
use function Jaxon\jaxon;
use Jaxon\Jaxon;
//2.- Creamos las funciones de validación que serán lammadas desde JS
function mostrarClima($ciudad)
{
    $resp = jaxon()->newResponse();
    $datos = new Temperatura($ciudad);
    $tiempo = $datos->getTiempo();
    //var_dump($tiempo);
    if (($tiempo['cod']) == 404) {
        $resp->assign('resultado', 'innerHTML', "ciudad no encontrada");
        //$resp->alert("Ciudad no");
    } else {
        $temp = $tiempo['main']['temp'];
        $tempGrados = $temp - 273.15;
        $resp->assign('resultado', 'innerHTML', $tempGrados . "º");
        //$resp->alert("Ciudad si");
    }
    return $resp;
}

//3.- Creamos el objeto jaxon
$jaxon = jaxon();

// Podemos incluir las opciones que queramos
$jaxon->setOption('js.app.minify', false);
$jaxon->setOption('core.decode_utf8', true);
$jaxon->setOption('core.debug.on', false);
$jaxon->setOption('core.debug.verbose', false);

// 4.- Registramos la función que vamos a llamar desde JavaScript
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'mostrarClima', ['mode' => "'asynchronous'"]);

// 5.- El método processRequest procesa las peticiones que llegan a la página
// Debe ser llamado antes del código HTML
if ($jaxon->canProcessRequest()) {
    $jaxon->processRequest();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CDN bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src ="clima.js" type="text/javascript"></script>
    <title>Document</title>
</head>
<body>

<?php
// EXAMEN 3º AVALIACION DWES

$url = 'http://127.0.0.1/pregunta3/servidorSoap/servicio.wsdl';
try {
    $cliente = new SoapClient($url);
} catch (SoapFault $f) {
    die("Error en cliente SOAP:" . $f->getMessage());
}

$codP = 2;
$codT = 1;
$codF = 'MP3';

//---------------------------------------------------------------------------------------
$objeto = new ClasesOperacionesService();

//funcion getPvp ------------------------------------------------------------------------
$pvp = $objeto->getPvp($codP);
$precio = ($pvp == null) ? "No existe es Producto" : $pvp;
echo "Código de producto de Código $codP: $precio";

//funcion getFamilias -------------------------------------------------------------------
echo "<br>Códigos de Familas:";
$prueba = $objeto->getFamilias();
echo "<ul>";
foreach ($prueba as $k => $v) {
    echo "<code><li>$v</li></code>";
}
echo "</ul>";

//funcion getProductosFamila ------------------------------------------------------------
$productos = $objeto->getProductosFamilia($codF);
echo "<br>Productos de la Famila $codF:";
$prueba = $objeto->getProductosFamilia($codF);
echo "<ul>";
foreach ($prueba as $k => $v) {
    echo "<code><li>$v</li></code>";
}
echo "</ul>";

// funcion getStock ---------------------------------------------------------------------
$unidades = $objeto->getStock($codP, $codT);
echo "<br>Unidades del producto de código $codP en la tienda de código $codT: $unidades";

/**************************************PREGUNTA 3b)******************************************* */
// funcion getCiudadTienda ---------------------------------------------------------------------
$ciudad = $objeto->getCiudadTienda($codT); //usamos ya el código declarado
echo "<br>La ciudad de la tienda con id $codT es $ciudad";
echo "<br>";

/**************************************PREGUNTA 3c.1)******************************************* */
// funcion getCiudadTienda ---------------------------------------------------------------------
$idsTienda = $objeto->getIdsT(); //usamos ya el código declarado de la clase Operaciones
//echo "<br>La ciudad de la tienda con id $codT es $ciudad";
$idsProducto = $objeto->getIdsP();
$idsFamilia = $objeto->getFamilias();
?>

<!-------------------------------PREGUNTA 3C--------------------------------------->
<?php
// Si hemos enviado las preferencias la guardamos en sesiones.
if (isset($_GET['enviar'])) {
    $_SESSION['codigoTienda'] = $_GET['codigoTienda'];
    $_SESSION['codigoProducto'] = $_GET['codigoProducto'];
    $_SESSION['codigoFam'] = $_GET['codigoFam'];
    $_SESSION['fecha'] = $_GET['fecha'];
}
?>

<br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
<!--guardamos en una sesión y cuando recargue la página almacene su dato:-->
<div class="mb-3">
    <label for="codigoTienda">Código de tienda</label>
    <!--<input type = "text" id="codigoTienda" name="codigoTienda" value="<?php //echo (isset($_SESSION['codigoTienda']))?$_SESSION['codigoTienda']:''; ?>"> -->
    <select class="form-control" name='codigoTienda' id="id">

<?php
if (isset($_SESSION['codigoTienda'])) {
    $codTienda = $_SESSION['codigoTienda'];
} else {
    $codTienda = '';
}

$codigoTienda = $idsTienda; //le damos el valor del array de todos los ids
foreach ($codigoTienda as $k => $v) {
    if (isset($_SESSION['codigoTienda']) && $_SESSION['codigoTienda'] == $k + 1) {
        echo "<option value='$v' selected>$v</option>";
    } else {
        echo "<option value='$v'>$v</option>";
    }
}
?>
    </select>
</div>

<div class="mb-3">
    <label for="codigoProducto">Código de producto</label>
    <select class="form-control" name='codigoProducto' id="id">

<?php
if (isset($_SESSION['codigoProducto'])) {
    $codProducto = $_SESSION['codigoProducto'];
} else {
    $codProducto = '';
}

$codigoProducto = $idsProducto; //le damos el valor del array de todos los ids
foreach ($codigoProducto as $k => $v) {
    if (isset($_SESSION['codigoProducto']) && $_SESSION['codigoProducto'] == $k + 1) {
        echo "<option value='$v' selected>$v</option>";
    } else {
        echo "<option value='$v'>$v</option>";
    }
}
?>
    </select>
</div>

<div class="mb-3">
    <!-- <input type = "text" id="codigoProducto" name="codigoProducto" value="<?php //echo (isset($_SESSION['codigoProducto'])) ? $_SESSION['codigoProducto'] : ''; ?>"> -->
    <label for="codigoFam">Código de familia</label>
    <select class="form-control" name='codigoFam' id="id">

<?php
if (isset($_SESSION['codigoFam'])) {
    $codFamilia = $_SESSION['codigoFam'];
} else {
    $codFamilia = '';
}

$codigoFam = $idsFamilia; //le damos el valor del array de todos los ids
foreach ($codigoFam as $k => $v) {
    if (isset($_SESSION['codigoFam']) && $_SESSION['codigoFam'] == $k + 1) {
        echo "<option value='$v' selected>$v</option>";
    } else {
        echo "<option value='$v'>$v</option>";
    }
}
?>
    </select>
</div>

<div class="mb-3">
    <!--<input type = "text" id="codigoFam" name="codigoFam" value="<?php //echo (isset($_SESSION['codigoFam'])) ? $_SESSION['codigoFam'] : ''; ?>"> -->
    <label for="fecha">Código de tienda</label>
    <input type = "date" id="fecha" name="fecha" value="<?php echo (isset($_SESSION['fecha'])) ? $_SESSION['fecha'] : ''; ?>">
</div>

<button type="submit" id="enviar" class="btn btn-info" name="enviar">Enviar</button>

</form>

<?php
/*******************************Pregunta 3c.1************************************************** */
$ciudad = $objeto->getCiudadTienda($codTienda); //usamos ya el código declarado
if (isset($_GET['enviar'])) {
    // funcion getCiudadTienda ---------------------------------------------------------------------
    echo "<br>La ciudad de la tienda con id $codTienda es $ciudad";
}
//session_destroy();//comprobamos
?>

<!--/**********************************Pregunta 3d********************************************* */-->
<br>
<button type="button" id="clima" class="btn btn-warning" name="clima" onClick="<?php echo "muestraClima('{$ciudad}');" ?>">Clima</button>
<div id="resultado"></div>

</body>

<?php
// 6.- Injectamos los scripts javascript antes de enviar la página:
$jaxon = jaxon();
echo $jaxon->getCss(), "\n", $jaxon->getJs(), "\n", $jaxon->getScript(), "\n";
echo "<!-- HTTP comment  -->\n"
?>

</html>