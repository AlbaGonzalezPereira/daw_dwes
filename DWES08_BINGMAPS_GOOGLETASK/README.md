## ENUNCIADO TAREA08

### Tarea Repartos:

Partiendo de la aplicación web híbrida desarrollada en la unidad, sobre la gestión del servicio de repartos para la tienda web .

Se trata de modificar el código fuente de la aplicación para incluir las siguientes nuevas funcionalidades:

**Modificaremos el formulario** ``"Crear Envio"`` ahora nos mostrará también la **altitud** y los **productos** los cogeremos directamente de la tabla ``productos`` de la base de datos proyecto que hemos utilizado en otras unidades. Mostraremos en un campo de tipo ``"select"`` el nombre de los mismos.(NOTA: la altitud obtenida no es necesario procesarla posteriormente de ninguna forma; solo mostrarla). 

En la **página principal** para crear un nuevo reparto ahora solo pondremos la fecha en un campo de tipo ``"date"`` y se nos añadirá el nombre, por ejemplo si elegimos la fecha ``"20/20/2022"`` crearemos una lista de tareas de nombre ``"Repartos 20/20/2022"``. Controlaremos que la fecha no sea inferior a la actual y que no pueda haber dos listas de tareas para el mismo día. Al igual que en la tarea de la unidad el reparto de cada día sera una nueva lista de tareas en ``"Google Tasks"`` y cada reparto en ese día una tarea en la lista.

**Añadiremos funcionalidad** al botón ``mapa`` de manera que al ver podamos ver en un mapa la dirección de un envío. Para ello mandaremos por "GET" las coordenadas y las mostraremos en un mapa.

Ahora cuando le demos al botón ``ordenar`` nos aparecerá los **envíos ordenados** y un botón ``"Ver ruta en mapa"`` para ver la ruta (optimizada por distancia). El botón mandará por ``"POST"`` a la página ``"rutas.php"`` el array de coordenadas para mostrar la ruta (acuérdate de mandar las coordenadas ficticias del almacén como principio y fin de la ruta).

Añadiremos un **botón para ocultar el orden**.

---
---
## MODIFICACIONES Y FUNCIONALIDADES AÑADIDAS:

### MODIFICACIONES:
1. Modificación del bug en el archivo ``Coordenadas.php``, línea 30:

**ANTES:** 
   ```php
   $this->url = $this->$iniciourl . "$dir" . $this->finurl;
   ```
**AHORA:**
  ```php
  $this->url = $this->iniciourl . "$dir" . $this->finurl;
  //(QUITAR DOLAR al inicioourl, como es lógico)
  ```

2. Modificación de las **claves de Bing Maps** y de Google Task en el archivo ``claves.inc.php``:
```php
//clave bing generada
$keyBing = "xxxxxxxxxxxx";  

//claves que me proporcionaste
$googleClientId     = 'xxxxxxxxxxxxxxx'; 
$googleClientSecret = 'xxxxxxxxxxxxxxx'; 
```

3. Modificación de las **coordenadas del almacén**, así como su ubicación en el archivo ``config.inc.php``:
```php
<?php
//configuramos las coordenadas donde se halla el almacén
$corAlmacen = "42.42972,-8.643261";  //Calle de la Peregrina 25, 36001 Pontevedra
$miCiudad   = "Pontevedra";
```
4. Modificación de **authors** y **name** en el archivo ``composer.json``:
```bash
"name": "alba/tarea8",

"authors": [
        {
            "name": "Alba",
            "email": "alba@hotmail.com"
        }
    ],
```
---
### FUNCIONALIDADES AÑADIDAS:

1. Se ha añadido una funcionalidad en ``repartos.php`` para que no tenga que recargar la página al ocultar el Orden:

En la línea 192, hemos añadido el ``id="ocultar"`` y hemos eliminado el ``href``:
```php
//modificamos el enlace y eliminamos el href='repartos.php?action=oce&idlt={$lista->getId()}' para que nos permita ocultar la orden
//añadimos el id="ocultar"
echo "<a id='ocultar' class='btn btn-primary mr-2 btn-sm'><i class='fas fa-eye-slash mr-1'></i>Ocultar orden</a>\n";
```
En la línea 222 hemos añadido el id="orden"
```php
//añadimos el id="orden" para poder ocultar el elemento al llamarlo con el botón
echo "<div id='orden' class='container mt-2 mb-2' style='font-size:0.8rem'>";
```
2. Se ha añadido la funcionalidad de **Ver Orden** en el archivo ``funciones.js``, que nos va a cambiar el estilo, el icono y el texto del botón.
```javascript
$(document).ready(function() {
    $('#ocultar').click(function() {//al darle clic en el elemento con id="ocultar"
      $('#ocultar').toggleClass( "ver" );
      if($('#ocultar').hasClass('ver')){
          //para cambiar el color, icono y el texto del botón
          $('#ocultar').removeClass("btn-primary");
          $('#ocultar').addClass("btn-light");
          $('#ocultar').html("<i class='fas fa-eye mr-1'></i>Ver orden");//cambiamos icono y texto
      }else{
          $('#ocultar').removeClass("btn-light");
          $('#ocultar').addClass("btn-primary");
          $('#ocultar').html("<i class='fas fa-eye-slash mr-1'></i>Ocultar orden");
      }
      $('#orden').toggle();//oculta el elemento con id="orden"
    });
  }
```

3. Se ha añadido una funcionalidad en el archivo ``mapas.php`` para que, en caso de que exista el Street View de la coordenada, **muestre la imagen del sitio** donde va a realizar el reparto en un ``div`` debajo de la otra imagen y, sino, que muestre lo que contiene el atributo ``"alt"``.

Esto lo hacemos debajo de la función de ``loadMapScenario()``, añadiendo el siguiente **código** que nos va a generar la url con las coordenadas del Street View:
```php
let map2=`https://dev.virtualearth.net/REST/v1/Imagery/Map/Streetside/${lat},${lon}?zoomlevel=3&heading=145&pitch=5&mapSize=350,350&key=AvnkD-oufg5_jF9ZKSKelKwOchYW1bsjd-V1hynvL5edd-TIcQM-oGAGZUuwu_Qw`;
console.log(map2);
fetch(map2)
//.then(response => response.json())
.then(data => {
// Aquí puedes manipular los datos obtenidos
    let imagen= document.querySelector("#map2");
    let im=document.createElement("img");
    im.setAttribute('src',data.url);
    im.setAttribute('alt','Imagen del lugar de reparto');
    imagen.appendChild(im);
    //console.log(data.url);
})
.catch(error => {
    // Aquí puedes manejar errores
    console.error('Error al obtener los datos:', error);
});
```
En ``body``, para que nos cargue la imagen en el div con ``id="mapaStreet"``:

```php
body onload='loadMapScenario();' style="background:#00bfa5;">
    <div class="container mt-3 ">
        <div class="d-flex justify-content-center">
            <div id='myMap' style='width: 650px; height: 420px;'></div><!--muestra el mapa de la dirección-->
            <div class="mt-r">
            </div>
        </div>
        <!--Funcionalidad añadida: imagen del Street View-->
        <div class="d-flex justify-content-center">
            <div id='mapaStreet'></div><!--muestra la imagen del Street View de la dirección-->
            <div class="mt-r my-4" id="map2">
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <a href='repartos.php' class='btn btn-warning'>Volver</a>
        </div>
    </div>
</body>
```
