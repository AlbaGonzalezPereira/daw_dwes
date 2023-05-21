## ENUNCIADO TAREA08

### Tarea Repartos:

Partiendo de la aplicación web híbrida desarrollada en la unidad, sobre la gestión del servicio de repartos para la tienda web .

Se trata de modificar el código fuente de la aplicación para incluir las siguientes nuevas funcionalidades:

**Modificaremos el formulario** ``"Crear Envio"`` ahora nos mostrará también la **altitud** y los **productos** los cogeremos directamente de la tabla ``productos`` de la base de datos proyecto que hemos utilizado en otras unidades. Mostraremos en un campo de tipo ``"select"`` el nombre de los mismos.(NOTA: la altitud obtenida no es necesario procesarla posteriormente de ninguna forma; solo mostrarla). 

En la **página principal** para crear un nuevo reparto ahora solo pondremos la fecha en un campo de tipo ``"date"`` y se nos añadirá el nombre, por ejemplo si elegimos la fecha ``"20/20/2022"`` crearemos una lista de tareas de nombre ``"Repartos 20/20/2022"``. Controlaremos que la fecha no sea inferior a la actual y que no pueda haber dos listas de tareas para el mismo día. Al igual que en la tarea de la unidad el reparto de cada día sera una nueva lista de tareas en ``"Google Tasks"`` y cada reparto en ese día una tarea en la lista.

**Añadiremos funcionalidad** al botón ``mapa`` de manera que al ver podamos ver en un mapa la dirección de un envío. Para ello mandaremos por "GET" las coordenadas y las mostraremos en un mapa.

Ahora cuando le demos al botón ``ordenar`` nos aparecerá los **envíos ordenados** y un botón ``"Ver ruta en mapa"`` para ver la ruta (optimizada por distancia). El botón mandará por ``"POST"`` a la página ``"rutas.php"`` el array de coordenadas para mostrar la ruta (acuérdate de mandar las coordenadas ficticias del almacén como principio y fin de la ruta).

Añadiremos un **botón para ocultar el orden**.