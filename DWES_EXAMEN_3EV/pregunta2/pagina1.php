<?php
session_start(); //iniciamos sesión
//require_once './include/Palindromo.php';
spl_autoload_register(function ($clase) {
    include "./include/" . $clase . ".php";
});
if(!isset($_SESSION['nombre'])){//si no está definida la sesión de usuario
    header("location: login.php");//redirigimos a la página de inicio de sesión
    die();//finalizamos la ejecución del script
}

/**************************EJERCICIO 2C***************************************** */
//1.- Incluimos las librerias Jaxon
require(__DIR__ . '/vendor/autoload.php');
//require(__DIR__ . './include/Palindromo.php');
use Jaxon\Jaxon;
use function Jaxon\jaxon;
use Jaxon\Response\Response;

/**
 * función que nos almacena los datos en las tablas de la bbdd. Registramos con CALLABLE_FUNCTION
 */
function almacenarTabla(){
    
    $respuesta = jaxon()->newResponse();
    $error = false;
    $pal= new Palindromo();
    $pal->setUsuario("asd");
    $pal->setFrase("asdddasassda");
    $pal->setEsPalindromo(0);

    $respuesta->alert("Todo correcto.");
    $conProyecto=null;
    return $respuesta;
}

//3.- Creamos el objeto jaxon
$jaxon = jaxon();

// Podemos incluir las opciones que queramos
$jaxon->setOption('js.app.minify', false);
$jaxon->setOption('core.decode_utf8', true);
$jaxon->setOption('core.debug.on', false);
$jaxon->setOption('core.debug.verbose', false);


// 4.- Registramos la función que vamos a llamar desde JavaScript
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'almacenarTabla', ['mode' => "'asynchronous'"]);


// 5.- El método processRequest procesa las peticiones que llegan a la página
// Debe ser llamado antes del código HTML
if($jaxon->canProcessRequest())  $jaxon->processRequest();


/*****************************PREGUNTA 2b)********************************* */
//modificar la pagina1.php para que muestre el nombre del usuario "logeado"
echo "HOLAAA" . "<br>";
echo "usuario: " . $_SESSION['nombre']."<br>";
echo "FIN";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Alba Gonzalez">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js" defer></script>
    <title>Tarea 2a - Examen 3EV</title>
</head>
<body style="font-family: monospace">
    <form action ="<?php $_SERVER['PHP_SELF']?>" method="get">
        <div class="entrada">
            <p>
                <label for="frase">Introduce una frase en minúsculas y sin acentos:</label>
                <input type="text" id="frase" name="frase" />
            </p>
            <p id="error">
            <?php
if (isset($_GET['enviar'])) {
    if (empty($_GET['frase'])) {
        echo "<h3>Debe introducir una frase!!</h3>";
    }
}
?>
        </p>
        <button id="enviar" type="submit" name="enviar">Enviar</button>
        <button id="borrar" type="" name="borrar">Reset</button>
        <!-------------------PREGUNTA 2c------------------------->
        <!--Añadimos botón persistir-->
        <button id="persistir" name="persistir" onClick="almacenar();return false;">Persistir</button>

        <p id = "correcta"></p>
    </div>
        </form>
        <?php
//si la sesión no está definida
if (!isset($_SESSION['pag1'])) {
    $asociat = []; //creamos el array asociativo
} else {
    $asociat = $_SESSION['pag1']; //y sino lo igualamos a la sesión
}
//unset($_SESSION);

if (isset($_GET['enviar'])) {
    if (empty($_GET['frase'])) {
        echo "<h3>Debe introducir una frase!!</h3>";
    } else {
        $frase = $_GET['frase'];
    }

}

if (isset($_GET['enviar'])) {
    if (!empty($_GET['frase'])) {
        $regex = "/^[a-z ]+$/"; //expresión regular que valida la frase
        $frase = $_GET['frase'];
        $trozoFrase = preg_split("/\s+/", $frase); //cortamos la frase para sacar los espacios
        $fraseSinEsp = implode($trozoFrase); //unimos la frase
        $fraseReves = strrev($fraseSinEsp); //le damos la vuelta a la frase
        $reves = strrev($frase); //invertimos la frase
        $esPal = false; //declaramos palíndromo
        //$asociat = array($esPal,$frase);
        if (preg_match($regex, $frase)) { //comprobamos la frase
            echo "<p>Escrita al revés: " . $reves . "</p>";
            if ($fraseReves == $fraseSinEsp) {
                echo "<p>Es un palíndromo</p>";
                $esPal = true;
            } else {
                echo "<p>No es un palíndromo</p>";
            }
            $asociat[$frase] = $esPal; //creamos el array asociativo
        }

        echo "<br><p>Frases probadas hasta el momento: </p>";
        echo "<table>";
        echo "<tr><th>Palíndromo</th><th>Frase</th>";//ponemos encabezados de tabla en negrita
        foreach ($asociat as $it => $value) { //recorremos el array asociativo
            echo "<tr>";
            echo "<td>";
            //comprobamos palíndromos para que escriba Palíndromo o No
            if ($value == true) {
                echo "Palíndromo";
            } else {
                echo "No";
            }

            echo "</td><td>";
            echo $it . "</td></tr>";
        }
        echo "</table>";
    }
}

$_SESSION['pag1'] = $asociat; //guarda en $_SESSION lo que tenemos en el array (frase, palíndromo)

//cando le damos a borrar, cerramos la sesión. IMPORTANTE, ponerlo abajo
if (isset($_GET['borrar'])) {
    unset($_SESSION['pag1']);
}
?>

</body>

<?php
// 6.- Injectamos los scripts javascript antes de enviar la página (poner después de body):
$jaxon = jaxon();
echo $jaxon->getCss(), "\n", $jaxon->getJs(), "\n", $jaxon->getScript(), "\n";
echo "<!-- HTTP comment  -->\n"
?>
</html>