<?php
// DOCUMENTACIÓN DE LA API EN:
// Learn -> Bing Maps -> Bing Maps V8 Web Control
// https://learn.microsoft.com/en-us/bingmaps/v8-web-control/?toc=https%3A%2F%2Flearn.microsoft.com%2Fen-us%2Fbingmaps%2Fv8-web-control%2Ftoc.json&bc=https%3A%2F%2Flearn.microsoft.com%2Fen-us%2FBingMaps%2Fbreadcrumb%2Ftoc.json


if (!isset($_GET['lat'])) {
    header('Location: repartos.php');
    die();
}

include("../../claves.inc.php");
$urlBingMaps = 'https://www.bing.com/api/maps/mapcontrol?key='. $keyBing;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Mapa</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <script type='text/javascript' src=<?php echo '"' . $urlBingMaps . '"'?>></script> <!-- OCULTAR -->
    <script type='text/javascript'>
        //esta funcion coge de la url los parámetros get, en este caso lat y lon y devuelve su valor
        function getParameterByName(name) {
            name        = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            let regex   = new RegExp("[\\?&]" + name + "=([^&#]*)");
            let results = regex.exec(location.search);

            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }

        var map;
        var lat = getParameterByName('lat');
        var lon = getParameterByName('lon');

        /**
         * Función que carga un mapa
         */
        function loadMapScenario() {
            map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
                center: new Microsoft.Maps.Location(lat, lon),
                mapTypeId: Microsoft.Maps.MapTypeId.canvasLight,
                zoom: 17
            });
        }

        //para que nos genere la url con las coordenadas del Street View
        let map2=`https://dev.virtualearth.net/REST/v1/Imagery/Map/Streetside/${lat},${lon}?zoomlevel=3&heading=145&pitch=5&mapSize=350,350&key=AvnkD-oufg5_jF9ZKSKelKwOchYW1bsjd-V1hynvL5edd-TIcQM-oGAGZUuwu_Qw`;
        console.log(map2);
        fetch(map2)
        //.then(response => response.json())
        .then(data => {
            // Aquí puedes manipular los datos obtenidos
            let imagen= document.querySelector("#map2");
            let im=document.createElement("img");
            im.setAttribute('src',data.url);
            //imagen.appendChild(im);
            im.setAttribute('alt','Imagen del lugar de reparto');
            imagen.appendChild(im);
            //console.log(data.url);
        })
        .catch(error => {
            // Aquí puedes manejar errores
        console.error('Error al obtener los datos:', error);
        });
    </script>
</head>

<body onload='loadMapScenario();' style="background:#00bfa5;">
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

</html>
