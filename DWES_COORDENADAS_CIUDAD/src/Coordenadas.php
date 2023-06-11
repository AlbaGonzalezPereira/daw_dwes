<?php

class Coordenadas  {
    //atributo url
    private $urlLocalizacion = "http://dev.virtualearth.net/REST/v1/Locations";//url api

    private $revGeocodeUrl;//url completa

    public function __construct($la, $lo)   {
        include("claves.inc.php"); //IMPORTANTE. Incluir el archivo ya que no está incluido
     
        // Preparar datos acceso servicio localizacion Bing:
        $this->revGeocodeUrl = $this->urlLocalizacion . "/$la,$lo?c=es&output=json&key={$keyBing}";
    }

    /**
     * Función que nos devuelve una localización
     */
    public function getLocalizacion() {
        $salida  = file_get_contents($this->revGeocodeUrl);
        $salida1 = json_decode($salida, true);

        return $salida1["resourceSets"][0]["resources"][0]["address"];
    }
}
