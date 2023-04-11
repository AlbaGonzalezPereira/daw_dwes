## ENUNCIADO

### **Jugadores**

Deseamos diseñar una aplicación para gestionar los **jugadores** de un equipo de futbol. Para dicha aplicación trabajaremos con la tabla jugadores, para ella nos crearemos una base de datos nueva y un usuario con permiso en ella. Podemos reutilizar el usuario gestor, de otros ejercicios.

Se deja el enlace a "``tablas.sql``" con lo necesario para crear la base de datos, dar a **gestor** permiso en ella y crear la tabla **jugadores**.

[Archivo SQL](#https://github.com/AlbaGonzalezPereira/daw_dwes/blob/main/DWES05/sql/DWES05_TAR_R01_tabla.sql)

De los jugadores guardaremos nombre y apellidos, una posición, un número de dorsal (único) y un código de barras obligatorio único para cada uno.

**Dependencias obligatorias a instalar con Composer**.

* ``philo/laravel-blade`` como motor de plantillas.
* ``milon/barcode`` Para generar los códigos de barra (Se utilizara el formato EAN-13, que utiliza 13 números).
* ``fzaninotto/faker`` Para genera datos aleatorios de prueba.
* ``autoload`` con optimizador.

Estructura del proyecto ya terminada, lógicamente puedes usar los nombre de carpetas y ficheros que quieras:

1. "``cache``" : Esta carpetas es necesaria crearla, y darle permiso "``777``" si estamos en Linux, para **Blade** y **Barcode**.

2. "``public``": Aquí crearemos todas las páginas que visualizaremos desde el navegador o páginas "``.php``" para procesar algo. Las páginas que tendrá seran:

    * "``crearDatos.php``" : Está página me genera los datos de ejemplo.

    * "``crearJugador.php``" : está página es el "``action``" del formulario para crear un jugador. Controlaremos errores para no introducir un **dorsal** que ya existe, que **nombre** y **apellidos** no esté vacios.

    * "``fcrear.php``": Es el formulario para crear el jugador. Llama a la vista: "``vcrear.blade.php``". A parte de los botones normales pondremos un botón para generar un código de barras válido ("``href``" a la página "``generarCode.php``"). El campo para el código de barra lo pondremos de sólo lectura (atributo "``readonly``")

    * "``generarCode.php``": Está página me genera un código de barras **EAN-13** válido y que además no exista en la base de datos.

    * "``index.php``": Es la página de inicio, si la tabla jugadores no tiene datos llamará a "``instalacion.php``" para crearnos unos datos de ejemplo, si los tiene cargará la página "``jugadores.php``"

    * "``instalacion.php``": Carga la vista "``vinstalacion.php``" básicamente un botón para ir a "``crearDatos.php``" y crearnos datos de ejemplo.

    * "``jugadores.php``": Llama a la vista "``vjugadores.php``" Muestra en una tabla los datos de los jugadores. Tiene un botón crear que llama al formulario para crear un jugador nuevo. Si un jugador NO tiene **dorsal** mostraremos "**Sin asignar**".
    <br><br>

3. "``sql``" : Tiene el archivo "``.sql``", no es necesaria realmente.

4. "``src``": Contiene las Clases para gestionar la base de datos:

    * "``Conexion.php``": Para crear la conexión.
    * "``Jugador.php``": Para gestionar la tabla "**jugadores**". Aquí estarán los métodos para comprobar el "**barcode**", el **dorsal**, devolver los jugadores, insertarlos...En fin todos los que sean necesarios.
    <br><br>

5. "``vendor``": La genera **Composer**.

6. "``views``": Guardaremos todas las vistas ya mencionadas y la plantillas que utilizaremos.

A parte de todo esto está el archivo: "``composer.json``".