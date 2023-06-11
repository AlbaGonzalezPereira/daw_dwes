<?php
//fijarse como están las carpetas
require(__DIR__ . '/../src/Datos.php'); 
require(__DIR__ . '/../vendor/autoload.php');

use Jaxon\Jaxon;
use function Jaxon\jaxon;
use Jaxon\Response\Response;

$jaxon = jaxon();

// Podemos incluir las opciones que queramos
$jaxon->setOption('js.app.minify', false);
$jaxon->setOption('core.decode_utf8', true);
$jaxon->setOption('core.debug.on', false);
$jaxon->setOption('core.debug.verbose', false);

if($jaxon->canProcessRequest())  $jaxon->processRequest();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js" defer></script>
    <title>Coordenadas</title>
</head>
<body >

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="get">
        <br>
        <label for="latitud">Latitud</label>
        <input type="text" id="latitud"/><br>
        <label for="longitud">Longitud</label>
        <input type="text" id="longitud" />
        <div id="resultado"></div>
        

        <button id="botonEnviar" type="button" name="enviar" onClick="obtenerLocalizacion();return false;">Enviar</button>
        
        <br>
        <div id ="texto"></div>
    </form>
</body>

<?php
//  Injectamos los scripts javascript antes de enviar la página:
$jaxon = jaxon();
echo $jaxon->getCss(), "\n", $jaxon->getJs(), "\n", $jaxon->getScript(), "\n";
echo "<!-- HTTP comment  -->\n"
?>

</html>