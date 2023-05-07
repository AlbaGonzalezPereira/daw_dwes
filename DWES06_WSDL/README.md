## PASOS PARA LA REALIZACIÓN DE LA TAREA
* Arrancamos el XAMPP.

* Primero buscamos **información sobre la extensión SOAP** de PHP en el entorno de línea de comandos (CMD) que contenga la cadena de texto "soap". Nos interesa saber si la caché está en off o a 0. Se comprueba con el siguiente comando en la terminal:
```bash
php -i | findstr /I "soap"
```

Teniendo que salir lo siguiente:
```
Soap Client => enabled
Soap Server => enabled
soap.wsdl_cache => 1 => 1
soap.wsdl_cache_dir => /tmp => /tmp
soap.wsdl_cache_enabled => Off => Off
soap.wsdl_cache_limit => 5 => 5
soap.wsdl_cache_ttl => 86400 => 86400
```
Hay que fijarse que la caché esté en off, que nos lo dirá la siguiente línea: 
```
soap.wsdl_cache_enabled => Off => Off
```

En caso de que no nos aparezca nada o no esté la caché en Off, haremos las siguientes comprobaciones:

* Comprobaremos que en ``php.ini`` (C:\xampp\php) la extensión soap esté **descomentada** ``extension=soap`` y la caché esté en **Off**, es decir, de la siguiente manera: ``soap.wsdl_cache_enabled=0``. 

* Una vez realizado lo anterior, volvemos a comprobar que está todo bien con el comando ``php -i | findstr /I "soap"``.

Si tenemos que realizar los cambios anteriores, tenemos que **reiniciar el XAMPP**.

* Si el proyecto no tiene un ``composer.json``, haremos un ``composer init`` y para ello seguiremos los pasos de instalación de Composer que se puede encontrar en el [pdf](https://github.com/AlbaGonzalezPereira/daw_dwes/blob/main/DWES05_COMPOSER/INSTALACI%C3%93N%20DE%20COMPOSER.pdf) de la tarea05, creando solo la carpeta vendor ya que, a priori, la carpeta caché no haría falta crearla. El archivo ``composer.json`` debería estar de la siguiente manera:
```json
{
    "name": "alba/tarea6",
    "description": "Practica Unidad6",
    "type": "project",
    "license": "gnu/gpl",
    "config": {
        "optimize-autoloader": true
    },
    "autoload": {
        "psr-4": {
            "Clases\\": "src"
        }
    },
    "authors": [
        {
            "name": "Alba María González Pereira",
            "email": "alba_gonzalezpereira@gmail.com"
        }
    ],
    "require": {}
```

* Si el proyecto ya tiene un ```composer.json``` y queremos modificarle el **name** o los **authors**, habría que eliminar el ```composer.lock```, hacer los cambios y después realizar un ```composer update```.
```bash
 "name": "alba/tarea6",
```

* Para **instalar las dependencias** que nos sean necesarias, lo haremos con **composer require**, que se instalarán dentro de require.

    En esta tarea, tenemos que instalar dos dependencias en el proyecto: 
    * **php2wsdl**, que nos va a permitir generar WSDL (Web Services Description Language) a partir de código PHP, 
    * **wsdl2phpgenerator**, la cual permite generar código PHP a partir de un archivo WSDL. La biblioteca se encarga de analizar el archivo WSDL y **generar clases y métodos** en PHP que se corresponden con los servicios web y los métodos descritos en el archivo WSDL. 

    En ambos casos, **Composer** genera un archivo ``composer.json`` y un archivo ``composer.lock`` que especifican las versiones exactas de las dependencias instaladas para asegurar la compatibilidad del proyecto.

    ```bash
    #Instalamos la biblioteca php2wsdl en el proyecto
    composer require php2wsdl/php2wsdl
    ```

    ```bash
    #Instalamos la biblioteca wsdl2phpgenerator en el proyecto actual 
    composer require wsdl2phpgenerator/ wsdl2phpgenerator
    ```

    Cuando instalemos la dependencia del wsdl2phpgenerator **TENEMOS QUE COMENTAR** las líneas **156-158** del fichero **vendor\wsdl2phpgenerator\lib\PhpClass.php** ya que tiene un bug y hacerlo cada vez que hagamos un composer update ya que genera un archivo nuevo.

    Quedando finalmente **"require": {}** en el archivo de composer.json de la siguiente manera:

    ```bash
    "require": {
        "php2wsdl/php2wsdl": "^0.6.1",
        "wsdl2phpgenerator/wsdl2phpgenerator": "^3.4"
    }
    ```

 * Una vez realizado todo lo anterior, creamos la **estructura de carpetas** del proyecto, si no nos la dieran.

* Después, importamos la estructura de **base de datos** y los datos de la misma, que estarán guardadas en la carpeta ``sql``.

 * En ``src`` tendremos que crear una **clase por cada tabla** de la base de datos aunque se puede simplificar todo en una clase, si fuese necesario, pero está mejor dejarlo todo separado.

* Tendremos que crear una clase ``Conexion.php`` de la que van a heredar el resto de clases que vayamos a usar. Si la copiamos hay que acordarse de **CAMBIAR los parametros de la conexión si fuera necesario**.

```php
<?php
//es la clase para conectarnos a una base de datos
namespace Clases;

//importamos las clases PDO y PDOException
use PDO;//permite conectarnos a bases de datos y ejecutar consultas SQL
use PDOException;//lanza una excepción si se produzca un error en la conexión o en la ejecución de consultas

class Conexion
{
    protected static $conexion;//es protected para que se puede acceder desde las clases que heredan de Conexión


    /**
     * Declaramos el constructor, que crea la conexión si no existe previamente, en caso contrario no hace nada
     */
    public function __construct()
    {
        if (self::$conexion == null) {
            self::crearConexion();
        }
    }

    /**
     * Función que nos crea una conexión con un usuario, contraseña, base de datos y la cadena de conexión dados
     */
    public static function crearConexion(){
        //ponemos usuario, contraseña, base de datos
        $user = "gestor";
        $pass = "secreto";
        $base='tarea6';
        $dsn = "mysql:host=localhost;dbname=$base;charset=utf8mb4"; //cadena de conexión para conectarse a la bbdd
        
        try {
            self::$conexion = new PDO($dsn, $user, $pass);//establece la conexión con los parámetros cadena de conexión, usuario y contraseña
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //lanza una excepción en caso de un error
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage());
        }
    }
}
```

* Tendremos también una clase ``Operaciones.php`` o similar, en la cual tendremos la funcionalidad del servicio web, es decir, el conjunto de **métodos disponibles**. Dentro de la clase ``Operaciones.php``, en cada método creamos objetos de otras clases y llamamos a sus métodos para recoger los datos. No hay que olvidarse de que **los comentarios** en esta clase deben seguir una **estructura específica** para poder generar el wsdl sin errores.

```php
<?php
//en Operaciones vamos a tener las funciones a las que podemos llamar. Los comemntarios deben seguir un determinado patrón 
//para que a la hora de generar las clases sea correctamente

namespace Clases;

require '../vendor/autoload.php';

use Clases\{Producto, Stock, Familia}; //para utilizar las tres clases

class Operaciones
{
    /**
     * Obtiene el PVP de un producto a partir de su codigo
     * @soap
     * @param int $codP
     * @return float
     */
    public function getPvp($codP)
    {
        $producto = new Producto();//creamos un objeto de la clase Producto, que a su vez establece una Conexión
        $producto->setId($codP);
        $precio = $producto->getPrecio();
        $producto = null;
        return $precio;
    }
    /**
     * Devuelve el numero de unidades que existen en una tienda de un producto
     * @soap
     * @param int $codP
     * @param int $codT
     * @return int
     */
    public function getStock($codP, $codT)
    {
        $stock = new Stock();//creamos un objeto de la clase Stock, que a su vez establece una Conexión
        $stock->setProducto($codP);
        $stock->setTienda($codT);
        $uni = $stock->getUnidadesTienda();
        $stock = null;
        return $uni;
    }
    /**
     * Devuelve un array con los codigos de todas las familias
     * @soap
     * @param
     * @return string[]
     */
    public function getFamilias()
    {
        $familas = new Familia();//creamos un objeto de la clase Familia, que a su vez establece una Conexión
        $valores = $familas->getFamilias();
        $familas = null;
        return $valores;
    }
    /**
     * Devuelve un array con los nombres de los productos de una familia
     * @soap
     * @param string $codF
     * @return string[]
     */
    public function getProductosFamilia($codF)
    {
        $productos = new Producto(); //creamos un objeto de la clase Producto, que a su vez establece una Conexión
        $datos = $productos->productoFamila($codF);//a partir de ese objeto llama a la función productoFamila
        $productos = null;//cerramos la conexión
        return $datos;//devuelve datos
    }
}
```

* En la carpeta servidorSoap tendremos el ``servicio.php``, del que haremos una **copia** y le llamaremos ``servicioW.php``, que contendrá la **ruta del archivo wsdl**, en nuestro caso ``servicio.wsdl``.

```php
<?php
/*esto es una copia de servicio.php, es decir, creamos un servidor soap pero añadiendo como parámetro el servicio.wsdl en vez del 
primer parámetro null que tenía servicio.php. También indica qué clase contiene las funciones (Clase Operaciones)*/

require '../vendor/autoload.php';
$url = "http://127.0.0.1/dwes_tema_06_alba/TAREA_06/servidorSoap/servicio.wsdl"; //ruta del archivo wsdl

try {
    $server = new SoapServer($url);//creamos el servidor
    $server->setClass('Clases\Operaciones'); //indica la clase que contiene las funciones
    $server->handle(); //inicia el servidor Soap
} catch (SoapFault $f) {
    die("error en server: " . $f->getMessage());
}
```

* Generamos el wsdl con ``generarWsdl.php``, que sólo haremos **una vez**, que podemos hacerlo desde la web, clicleando en generarWsdl.php o desde Visual Studio Code, seleccionando en **Ejecutar y Depurar**.

* Generamos las clases con ``generarClases.php``, también **solo una vez**, que en este caso nos genera la clase ``ClasesOperacionesService.php``. En caso de darle dos veces nos haría una copia, añadiendo Customize al final. Se generan de manera similar al wsdl, pero escogiendo el archivo ``generarClases.php``.

* En caso de querer **volver a generarlos**, o si queremos **añadir o modificar alguna funcionalidad**, tendremos que eliminar el wsdl y las clases previas generadas con ``generarClases.php`` y volver a generar el wsdl y las clases, como ya se explicó en puntos previos.

```php
/**
 * Devuelve un string con el teléfono de la tienda o null
 * @soap
 * @param string $nombre
 * @return string | null
 */
public function getTlfTienda($nombre)
{
    $tienda = new Tienda();//creamos un objeto de la clase Tienda
    //$tienda->setNombre($nombre);
    $telf = $tienda->getTelf($nombre);//llama a la función getTelf
    $tienda = null;//cierra la consulta
    return $telf;//devuelve el teléfono
}
```

* Por último, comprobamos los clientes (cliente.php, clienteW.php y clienteW2.php, en este caso).