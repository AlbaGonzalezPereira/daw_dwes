<?php

namespace Clases\Clases1;

class ClasesOperacionesService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
);

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = null)
    {
    
  foreach (self::$classmap as $key => $value) {
    if (!isset($options['classmap'][$key])) {
      $options['classmap'][$key] = $value;
    }
  }
      $options = array_merge(array (
  'features' => 1,
), $options);
      if (!$wsdl) {
        $wsdl = 'http://127.0.0.1/dwes06_WSDL_funcionalidad_agregada/TAREA_06/servidorSoap/servicio.wsdl';
      }
      parent::__construct($wsdl, $options);
    }

    /**
     * Obtiene el PVP de un producto a partir de su codigo
     *
     * @param int $codP
     * @return float
     */
    public function getPvp($codP)
    {
      return $this->__soapCall('getPvp', array($codP));
    }

    /**
     * Devuelve el numero de unidades que existen en una tienda de un producto
     *
     * @param int $codP
     * @param int $codT
     * @return int
     */
    public function getStock($codP, $codT)
    {
      return $this->__soapCall('getStock', array($codP, $codT));
    }

    /**
     * Devuelve un array con los codigos de todas las familias
     *
     * @return Array
     */
    public function getFamilias()
    {
      return $this->__soapCall('getFamilias', array());
    }

    /**
     * Devuelve un array con los nombres de los productos de una familia
     *
     * @param string $codF
     * @return Array
     */
    public function getProductosFamilia($codF)
    {
      return $this->__soapCall('getProductosFamilia', array($codF));
    }

    /**
     * Devuelve un string con el teléfono de la tienda o null
     *
     * @param string $nombre
     * @return string
     */
    public function getTlfTienda($nombre)
    {
      return $this->__soapCall('getTlfTienda', array($nombre));
    }

    /**
     * Función que devuelve la suma (montante) de los productos de una familia. IMPORTANTE!!!!
     *
     * @param string $codT
     * @return string
     */
    public function getmontante($codT)
    {
      return $this->__soapCall('getmontante', array($codT));
    }

}
