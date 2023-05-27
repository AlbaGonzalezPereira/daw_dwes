<?php
//en Operaciones vamos a tener las funciones a las que podemos llamar. Los comemntarios deben seguir un determinado patrón
//para que a la hora de generar las clases sea correctamente

namespace Clases;

require '../vendor/autoload.php';

use Clases\Familia;
use Clases\Producto;
use Clases\Stock;
use Clases\Tienda;
//para utilizar las cuatro clases

class Operaciones
{
    /**
     * Obtiene el PVP de un producto a partir de su codigo
     * @soap
     * @param int $codP
     * @return float
     */
    public function getPvp($codP)
    {
        $producto = new Producto(); //creamos un objeto de la clase Producto, que a su vez establece una Conexión
        $producto->setId($codP);
        $precio = $producto->getPrecio();
        $producto = null;
        return $precio;
    }
    /**
     * Devuelve el numero de unidades que existen en una tienda de un producto
     * @soap
     * @param int $codP
     * @param int $codT
     * @return int
     */
    public function getStock($codP, $codT)
    {
        $stock = new Stock(); //creamos un objeto de la clase Stock, que a su vez establece una Conexión
        $stock->setProducto($codP);
        $stock->setTienda($codT);
        $uni = $stock->getUnidadesTienda();
        $stock = null;
        return $uni;
    }
    /**
     * Devuelve un array con los codigos de todas las familias
     * @soap
     * @param
     * @return string[]
     */
    public function getFamilias()
    {
        $familas = new Familia(); //creamos un objeto de la clase Familia, que a su vez establece una Conexión
        $valores = $familas->getFamilias();
        $familas = null;
        return $valores;
    }
    /**
     * Devuelve un array con los nombres de los productos de una familia
     * @soap
     * @param string $codF
     * @return string[]
     */
    public function getProductosFamilia($codF)
    {
        $productos = new Producto(); //creamos un objeto de la clase Producto, que a su vez establece una Conexión
        $datos = $productos->productoFamila($codF); //a partir de ese objeto llama a la función productoFamila
        $productos = null; //cerramos la conexión
        return $datos; //devuelve datos
    }

    /**
     * Devuelve un string con el teléfono de la tienda o null
     * @soap
     * @param string $nombre
     * @return string | null
     */
    public function getTlfTienda($nombre)
    {
        $tienda = new Tienda(); //creamos un objeto de la clase Tienda
        //$tienda->setNombre($nombre);
        $telf = $tienda->getTelf($nombre); //lama a la función getTelf
        $tienda = null; //cierra la consulta
        return $telf; //devuelve el teléfono
    }

    /**
     * Función que devuelve la suma (montante) de los productos de una familia. IMPORTANTE!!!!
     * @soap
     * @param string $codT
     * @return string
     */
    public function getmontante($codT)
    {
        $productos = new Producto();
        $datos = $productos->getMontante($codT); //guarda en datos lo que hay en getMontante, que es la consulta
        $productos = null;
        //return $datos->montante;//por el AS de la consulta
        return $datos;
    }
}
