<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as Aplicacion;

class Ropa {
    
    private $id;
    private $nombre;
    private $stock;
    private $categoria;
    private $descripcion;
    private $precio;
    private $imagen;
    private $talla;
    private $color;

    public function __construct($nombre, $precio, $descripcion, $talla, $color, $stock, $categoria, $imagen = '') {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->talla = $talla;
        $this->color = $color;
        $this->stock = $stock;
        $this->categoria = $categoria;
        $this->imagen = $imagen;
    }

    //Para administracion

    public static function anadirRopa($nombre, $color, $categoria, $talla, $descripcion, $precio, $stock, $imagen){
        $result = true;
        $ropa = new Ropa($nombre, $precio, $descripcion, $talla, $color, $stock, $categoria, $imagen);
        if (!$ropa->anadir($ropa)){
            error_log("Error de inserción: No se ha podido insertar de manera correcta");
            $result  = false;
        }
        return $result;
    }
    public static function mismaropa($nombre){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM ropa R WHERE R.nombre='%s'", $conn->real_escape_string($nombre));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Ropa($fila['Nombre'], $fila['Stock'], 
                $fila['Color'], $fila['Categoria'], $fila['Talla'], 
                $fila['Descripcion'], $fila['Precio'], $fila ['Imagen']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    private static function anadir($ropa) {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("INSERT INTO ropa(Nombre, Stock, Color, Categoria, Talla, Descripción, Precio, Imagen) 
                        VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')"
                        , $conn->real_escape_string($ropa->nombre)
                        , $conn->real_escape_string($ropa->stock)
                        , $conn->real_escape_string($ropa->color)
                        , $conn->real_escape_string($ropa->categoria)
                        , $conn->real_escape_string($ropa->talla)
                        , $conn->real_escape_string($ropa->descripcion)
                        , $conn->real_escape_string($ropa->precio)
                        , $conn->real_escape_string($ropa->imagen));
        if ($conn->query($query)){
            $ropa->id = $conn->insert_id;
            $result = true;
        }else{
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public function insertaimagen($imagen){

    }

    public static function eliminarropa($nombre){
        $result = Ropa::eliminar($nombre);
    }

    private static function eliminar($nombre) {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE * FROM ropa R WHERE R.nombre = $nombre");
        if ($conn->query($query)){
            $result = true;
        }else{
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    static function mostrarproducto($id){
        $ropa = self::buscarRopa($id);
        return $ropa;
    }
    static function mostrarcatalogo(){
        $ropa = self::filtrarRopa();
        return $ropa;
    }

    //Para busqueda y filtros

    static function buscarRopa($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM ropa WHERE ID = '$id'";
        $ropa = array('ID', 'Nombre', 'Descripcion', 'Stock', 'Precio', 'Categoria', 'Talla', 'Color', 'Imagen');
        $result = $conn->query($query);
        if ($result != null){
            $resultado = $result->fetch_assoc();
            $ropa['ID'] = $id;
            $ropa['Nombre'] = $resultado['Nombre'];
            $ropa['Descripcion'] = $resultado['Descripcion']; 
            $ropa['Stock'] = $resultado['Stock'];
            $ropa['Precio'] = $resultado['Precio'];
            $ropa['Categoria'] = $resultado['Categoria']; 
            $ropa['Talla'] = $resultado['Talla'];
            $ropa['Color'] = $resultado['Color'];
            $ropa['Imagen'] = $resultado['Imagen'];
            return $ropa;
        }else{
            error_log("Error BD ({$conn->errno}):{$conn->error}");
        }

        return $ropa;
    }

    static function filtrarRopa(){
        $app = Aplicacion::getInstance();
        $conn = $app->getConexionBd();

        $titulo = $_SESSION['busqueda'];
        $tipo = $_SESSION['categoria'];
        $precio= $_SESSION['precio'];
        $color = $_SESSION['color'];
        $talla = $_SESSION['talla'];
    
        $condiciones = [];

        if (isset($titulo) && !empty($titulo)){
            $condiciones[] = "Nombre LIKE '%$titulo%'";
        }
        if (isset($tipo) && !empty($tipo)){
            $condiciones[] = "Categoria = '$tipo'";
        }
        if (isset($precio) && !empty($precio)){
            $condiciones[] = "Precio < '$precio'";
        }
        if (isset($color) && !empty($color)){
            $condiciones[] = "Color = '$color'";
        }
        if (isset($talla) && !empty($talla)){
            $condiciones[] = "Talla LIKE '%$talla%'";
        }

        $where = !empty($condiciones) ? ' where ' .implode(' AND ', $condiciones) : '';
        $sql = "SELECT * FROM ropa " . $where;

        $resultado = $conn->query($sql);
        $ropa = [];
        $i = 0;

        if($resultado != null) {
                foreach ($resultado as $fila) {
                $ropa[$i] = $fila;
                $i++;
            }
            
        }

        $resultado->free();

        return $ropa;     
    }

    
}