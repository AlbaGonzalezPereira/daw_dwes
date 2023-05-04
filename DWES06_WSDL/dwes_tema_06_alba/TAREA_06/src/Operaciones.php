<?php
//en Operaciones vamos a tener las funciones a las que podemos llamar. Los comemntarios deben seguir un determinado patrón 
//para que a la hora de generar las clases sea correctamente

namespace Clases;

require '../vendor/autoload.php';


use Clases\{Producto, Stock, Familia}; //para utilizar las tres clases

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
        $producto = new Producto();//creamos un objeto de la clase Producto, que a su vez establece una Conexión
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
        $stock = new Stock();//creamos un objeto de la clase Stock, que a su vez establece una Conexión
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
        $familas = new Familia();//creamos un objeto de la clase Familia, que a su vez establece una Conexión
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
        $datos = $productos->productoFamila($codF);//a partir de ese objeto llama a la función productoFamila
        $productos = null;//cerramos la conexión
        return $datos;//devuelve datos
    }
}
