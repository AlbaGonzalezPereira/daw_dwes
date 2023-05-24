<?php
// DOCUMENTACIÓN DE LA APIs REST: 
//  https://learn.microsoft.com/en-us/bingmaps/rest-services/
//   -> Locations
//   -> Elevation
//   -> Routes


/**
 * Clase que obtiene coordenadas, rutas y otra información a través de la API de Bing Maps
 */
class Coordenadas  {
   
    private $key = "";  
    private $iniciourl;
    private $coordenadas;

    private $finurl = "?include=ciso2&maxResults=1&c=es&key=";
    private $url;

    /**
     * Constructor Coordenadas.  
     */
    public function __construct()  {
        include("../../claves.inc.php");
        include '../src/config.inc.php';

        $this->iniciourl = "http://dev.virtualearth.net/REST/v1/Locations/ES/" . $miCiudad . "/"; 
        $this->coordenadas = $corAlmacen;
        $this->key = $keyBing;

        $num = func_num_args();

        if ($num == 1) {
            $this->finurl = "?include=ciso2&maxResults=1&c=es&key=" . $this->key;
            $dir = str_replace(" ", "%20", func_get_arg(0));
            $this->url = $this->iniciourl . "$dir" . $this->finurl;
        }

        if ($num == 0) {
            $this->finurl = "?include=ciso2&maxResults=1&c=es&key=" . $this->key;
        }
    }


    /**
     * función que devuelve las coordenadas geográficas
     * @return $valor - coordenadas
     */
    public function getCoordenadas()  {
        $salida   = file_get_contents($this->url);
        $salida1  = json_decode($salida, true);
        $valor    = $salida1["resourceSets"][0]["resources"][0]["point"]["coordinates"]; //mete la información del array en $valor
        $valor[2] = $this->calculaAltitud($valor); //Calcula la altitud llamando a la función calculaAltitud

        return $valor;
    }

    /**
     * función que calcula la altitud de unas coordenadas
     * @return $valor - latitud
     */
    public function calculaAltitud($c)  {
        $lat    = $c[0];//declaramos las variable de lat que corresponderá con la coordenadas geográficas de latitud
        $lon    = $c[1];//declaramos las variable de lat que corresponderá con la coordenadas geográficas de longitud
        $url    = "http://dev.virtualearth.net/REST/v1/Elevation/List?points=$lat,$lon&key=" . $this->key;
        $salida = file_get_contents($url);
        $valor  = json_decode($salida, true);
        
        return $valor["resourceSets"][0]["resources"][0]["elevations"][0];//valor de altitud
    }

    /**
     * función que ordena  los puntos de entrega de los envíos 
     * @return $resp[]
     */
    public function ordenarEnvios($dato)   {
        //Ponemos las coordenadas del almacen de origen y destino
        $base   = "http://dev.virtualearth.net/REST/v1/Routes/Driving?c=es&wp.0=" . $this->coordenadas . "&";
        $puntos = explode("|", $dato);
        $num    = 0;
        $trozo  = "";

        for ($i = $num; $i < count($puntos); $i++) {
            $trozo .= "wp." . ++$num . "=" . $puntos[$i] . "&";
        }

        $trozo .= "wp." . ++$num . "=" . $this->coordenadas . "&optwp=true&optimize=distance&ra=routePath&key=" . $this->key;
        $url = $base . $trozo;

        //die($url);
        $salida  = $this->getRemoteFile($url);
        $salida1 = json_decode($salida, true); 

        if (isset($salida1["errors"]) && $salida1['statusCode'] == 404) {
            return "404";
        }
        
        $wayp = $salida1["resourceSets"][0]["resources"][0]['waypointsOrder'];
        
        //quitamos el primero y el ultimo (inicio y fin) (El almacen)
        array_shift($wayp);
        array_pop($wayp);

        for ($i = 0; $i < count($wayp); $i++) {
            $resp[] = substr(strstr($wayp[$i], '.'), 1);
        }

        return $resp;//devolvemos el orden de los puntos de entrega
    }

    /**
     * Función que configura opciones de cURL, como la URL, el tiempo máximo de conexión
     * @return 
     */
    public function getRemoteFile($url, $timeout = 10)  {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);

        return ($file_contents) ? $file_contents : FALSE;
    }
}
