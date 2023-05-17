## **ENUNCIADO TAREA06**
Vamos a seguir utilizando para esta tarea la base de datos correspondiente a la tienda web.

En primer lugar deberás crear una base de datos de nombre ``"tarea6"``, similar a la que usamos en los ejercicios anteriores. Para acceder puedes reutilizar el usuario ``"gestor"`` y su contraseña ``"secreto"``.

A continuación utilizarás ``"PHP SOAP"`` para crear un servicio web con cuatro funciones que expongan información de la base de datos de la tienda online. En el primer servidor no deberás utilizaremos ningún archivo ``WSDL``. Después generaremos uno y lo usaremos.

Échale un vistazo a la estructura de la práctica propuesta para que te hagas un primera idea de los archivos que se piden.

Para la base de datos se deja en un archivo comprimido los archivos para crear la base de datos ``"tarea6"`` y sus tablas, y el archivo para guardar datos de ejemplos para las tablas: [Archivos] (https://github.com/AlbaGonzalezPereira/daw_dwes/tree/main/DWES06_WSDL/dwes_tema_06_alba/TAREA_06/sql)

Tendremos las carpetas:

* ``"public"``: donde crearemos los ficheros para llamar a los servicios que crearemos.
* ``"servidorSoap"``: donde generaremos nuestros servicios.
* ``"src"``: Guardaremos todas nuestras clases, la clase ``"Operaciones"`` con todas las funciones que nos ofrecerá, la clase ``"Conexion"``, y las clases ``"Producto, Familia y Stock"``, con los métodos para acceder a la bases de datos y gestionar las tablas, como vimos en unidades anteriores.
* ``"vendor"``: La generará automáticamente  Composer.

Para esta práctica se pedirá ``"autoload"`` de las clases, ``"php2wsdl"`` y ``"wsdl2phpgenerator"``, todo instalado con ``"Composer"``.


* Crearemos el servidor SOAP ``"servicio.php"`` en la carpeta ``"servidorSoap"``. Este servicio no tendrá asociado ningún archivo WSDL y ofrecerá las funciones siguientes (Todas implementadas en ``"src/Operaciones.php"``):
    * ``getPVP``. Esta función recibirá como parámetro el código de un producto, y devolverá el PVP correspondiente al mismo.
    * ``getStock``. Esta función recibirá dos parámetros: el código de un producto y el código de una tienda. Devolverá el stock existente en dicha tienda del producto.
    * ``getFamilias``. No recibe parámetros y devuelve un array con los códigos de todas las familias existentes.
    * ``getProductosFamilia``. Recibe como parámetro el código de una familia y devuelve un array con los códigos de todos los productos de esa familia.

* Para comprobar la correcta ejecución del servicio, programa también un cliente con nombre ``"cliente.php"`` en la carpeta ``"public"`` que realice una llamada a cada una de las funciones programadas y muestre el resultado obtenido.

* Con la extensión ``"php2wsdl"`` crea el archivo ``"public/generarWsdl.php"`` para generar el documento WSDL "servicio.wsdl" que guardaremos en ``"servidorSoap"``. Utilizando este documento  nos crearemos un nuevo servidor SOAP, ``"servicioW.php"`` que lo utilice.

* Para comprobar la correcta ejecución de este nuevo servicio, programa también un cliente con nombre ``"clienteW.php"`` en la carpeta ``"public"`` que realice una llamada a cada una de las funciones programadas y muestre el resultado obtenido.

* Partiendo de este nuevo servicio y de su descripción crearemos el fichero ``"public/generarClases"``, que  utilizará la herramienta ``"wsdl2php"`` para obtener una clase PHP. Esta clase la guardaremos en la carpeta ``"Clases1"`` dentro de ``"src"``.

* Crea un nuevo cliente llamado ``"clienteW2.php"`` que se base en ésta clase, para probar el nuevo servicio, mostrando los resultados obtenidos de forma similar a como hiciste en los casos anteriores.