<?php
session_start(); //iniciamos sesión

//require_once './include/Palindromo.php';
spl_autoload_register(function ($clase) {
    include "./include/" . $clase . ".php";
});
if (!isset($_SESSION['nombre'])) { //si no está definida la sesión de usuario
    header("location: login.php"); //redirigimos a la página de inicio de sesión
    die(); //finalizamos la ejecución del script
}

/******************************EJERCICIO 2C***************************************** */
//1.- Incluimos las librerias Jaxon
require __DIR__ . '/vendor/autoload.php';
//require(__DIR__ . './include/Palindromo.php');
use function Jaxon\jaxon;
use Jaxon\Jaxon;
use Jaxon\Response\Response;

/**
 * función que nos almacena los datos en las tablas de la bbdd. Registramos con CALLABLE_FUNCTION
 */
// 2. Declaramos la funcion que carga la información de la tabla palíndromos
function almacenarTabla()
{
    $respuesta = jaxon()->newResponse();

    // Comprobamos si hay algo en la tabla....
    if (isset($_SESSION['pag1'])) {
        require_once 'conexion.php';

        foreach ($_SESSION['pag1'] as &$fila) { // importante & pues es por referencia el acceso ...

            // Vamos a usar la propia tabla de palíndromos para guardar información si se transfirió la fila o no
            if (!isset($fila[2])) {
                $fila[2] = "enviado"; //añadimos una columna más para evitar que se envíen los datos que aparezcan como "enviado"
                $consulta = "insert into palindromos(usuario, frase, esPalindromo) values(:u, :f, :p)"; //consulta
                $stmt = $conProyecto->prepare($consulta); //preparamos la consulta

                try {
                    $stmt->execute([
                        ':u' => $_SESSION['nombre'],
                        ':f' => $fila[1],
                        ':p' => $fila[0],
                    ]);
                } catch (PDOException $ex) {
                    //$conProyecto lo coge de conexion.php (linea 8)
                    cerrarTodo($conProyecto, $stmt); //cerramos conexión y statement
                    $respuesta->assign("correcta", "innerHTML", "No se ha podido persistir");
                    return $respuesta;
                }
            }
        }
        cerrarTodo($conProyecto, $stmt);//cerramos conexión y statement
        $respuesta->assign("correcta", "innerHTML", "Se ha realizado correctamente la persistencia");
    } else {
        $respuesta->assign("correcta", "innerHTML", "No se ha podido persistir");
    }
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
if ($jaxon->canProcessRequest()) {
    $jaxon->processRequest();
}

/*****************************PREGUNTA 2b)********************************* */
//modificar la pagina1.php para que muestre el nombre del usuario "logeado"
echo "HOLAAA" . "<br>";
echo "usuario: " . $_SESSION['nombre'] . "<br>";
echo "FIN";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Alba Gonzalez">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
//si se ha definido enviar y la frase está vacía
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
        <button id="persistir" name="persistir" onClick="jaxon_almacenarTabla();return false;">Persistir</button>
        <p id = "correcta"></p> <!--aquí sacamos los datos al darle al botón persistir-->
    </div>
        </form>

<?php

/*******************************Pregunta 2a)********************************* */
//si se le ha dado a enviar y la frase no está vacía
if (isset($_GET['enviar'])) {
    if (!empty($_GET['frase'])) {
        $regex = "/^[a-z ]+$/"; //expresión regular que valida la frase
        $frase = $_GET['frase']; //guardamos en la variable la frase
        $trozoFrase = preg_split("/\s+/", $frase); //cortamos la frase para sacar los espacios
        $fraseSinEsp = implode($trozoFrase); //unimos la frase
        $fraseReves = strrev($fraseSinEsp); //le damos la vuelta a la frase
        $reves = strrev($frase); //invertimos la frase
        $esPal = 0; //declaramos palíndromo
        //$asociat = array($esPal,$frase);
        if (preg_match($regex, $frase)) { //comprobamos la frase
            echo "<p>Escrita al revés: " . $reves . "</p>";
            if ($fraseReves == $fraseSinEsp) {
                echo "<p>Es un palíndromo</p>";
                $esPal = 1; //porque lo guardamos así en la bbdd
            } else {
                echo "<p>No es un palíndromo</p>";
            }
            //guardamos un array dentro de $_SESSION y cada array contiene dos valores (llave y valor)
            $_SESSION['pag1'][] = [$esPal, $frase]; // para almacenar múltiples elementos dentro de $_SESSION['pag1'].
        }

        echo "<br><p>Frases probadas hasta el momento: </p>";
        echo "<table>";
        echo "<tr><th>Palíndromo</th><th>Frase</th></tr>"; //ponemos encabezados de tabla en negrita

        //Para mostrar la tabla y que ponga un No o Palíndromo, dependiendo del caso
        if (isset($_SESSION['pag1'])) {
            foreach ($_SESSION['pag1'] as $fila) {
                echo "<tr>";
                echo "<td>";
                echo $fila[0] == 0 ? "No" : "Palindromo"; 
                echo "</td>";
                echo "<td>" . $fila[1] . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }
}

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