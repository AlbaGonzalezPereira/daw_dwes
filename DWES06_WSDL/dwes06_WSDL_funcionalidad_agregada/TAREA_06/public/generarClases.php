<?php
/*Fichero para generar las clases de la carpeta Clases1, el cual sólo hay que ejecutarlo una vez para que genere las clases y no 
las vuelva a añadir a la carpeta. Para ello usamos el Wsdl2PhpGenerator, que nos genera el código php de las clases a partir de
un fichero wsdl, tal y como se indica a continuación*/
require '../vendor/autoload.php';
//para generar clases a partir de un wsdl
use Wsdl2PhpGenerator\Generator;
use Wsdl2PhpGenerator\Config;

$generator = new Generator(); //creamos un objeto Generator
$generator->generate( //llamamos al método generate(), el cual nos va a crear las clases, el cual recibe por parámetro un objeto Config
    new Config([//este objeto Config tendrá la configuración con la ruta del fichero wsdl, la ruta donde guarda las clases y establece el espacio de nombres
        'inputFile' => 'http://127.0.0.1/dwes06_WSDL_funcionalidad_agregada/TAREA_06/servidorSoap/servicio.wsdl',
        'outputDir' => '../src/Clases1', //en la carpeta Clases1
        'namespaceName' => 'Clases\Clases1' //para que nos genere las clases del servicio.wsdl
    ])
);

//esto sólo lo podemos hacer una vez y de la misma manera que generarWsdl