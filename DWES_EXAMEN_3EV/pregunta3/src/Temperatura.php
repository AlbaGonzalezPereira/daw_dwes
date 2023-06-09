<?php
namespace Clases;

require '../vendor/autoload.php';
//clase que se encarga de obtener datos de temperatura para una determinada ciudad

class Temperatura  {
    private $respuesta;

    private $urlTemperatura = 'https://api.openweathermap.org/data/2.5/weather?';

    private $opciones;
    
    /**
     * Constructor Temperatura
     */
    public function __construct($ciudad)   {
        include("claves.inc.php");
     
        // Preparar datos acceso a consulta REST tiempo:
        $urlCompleto = $this->urlTemperatura . 'q=' . $ciudad . '&limit=5' . "&appid=" . $keyOpenWeatherMap;

        $this->opciones = array(
            CURLOPT_URL => $urlCompleto,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            )
        );         
    }

    /**
     * Devuelve el tiempo
     */
    public function getTiempo()  {
        $ch = curl_init();
        curl_setopt_array($ch, $this->opciones);
        $respuesta = curl_exec($ch);
        curl_close($ch);
        $salida = json_decode($respuesta, true);       
        return $salida;
    }

}
