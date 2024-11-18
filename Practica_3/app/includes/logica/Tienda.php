<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as Aplicacion;

class Tienda {
    
    private $id;
    private $nombre;
    private $codigopostal;
    private $provincia;
    private $localidad;
    private $direccion;
    private $telefono;
    private $horario;


    public function __construct($nombre, $codigopostal,$provincia,$localidad, $direccion, $telefono, $horario) {
        $this->nombre = $nombre;
        $this->codigopostal = $codigopostal;
        $this->provincia = $provincia;
        $this->localidad = $localidad;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->horario = $horario;
    }

    //Para administracion
    public static function anadirTienda($nombre, $codigopostal, $provincia, $localidad, $direccion, $telefono, $horario){
        $result = true;
        $tienda = new Tienda($nombre, $codigopostal, $provincia, $localidad, $direccion, $telefono, $horario);
        if (!$tienda->anadir($tienda)){
            error_log("Error de inserción: No se ha podido insertar de manera correcta");
            $result  = false;
        }
        return $result;
    }
    public static function mismatienda($localidad){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM tiendas   WHERE localidad='%s'", $conn->real_escape_string($localidad));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Tienda($fila['Nombre'], $fila['Codigopostal'], 
                $fila['Provincia'], $fila['Localidad'], $fila['Direccion'], 
                $fila['Telefono'], $fila['Horario']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    
    private static function anadir($tienda) {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("INSERT INTO tiendas(Nombre, Codigopostal, Provincia, Localidad, Direccion, telefono, horario) 
                        VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')"
                        , $conn->real_escape_string($tienda->nombre)
                        , $conn->real_escape_string($tienda->codigopostal)
                        , $conn->real_escape_string($tienda->provincia)
                        , $conn->real_escape_string($tienda->localidad)
                        , $conn->real_escape_string($tienda->direccion)
                        , $conn->real_escape_string($tienda->telefono)
                        , $conn->real_escape_string($tienda->horario));
        if ($conn->query($query)){
            $tienda->id = $conn->insert_id;
            $result = true;
        }else{
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    

    public static function eliminartienda($id)
	    {
		    $app = Aplicacion::getInstance();
		    $conn = $app->getConexionBd();

		    $sql = "DELETE FROM `tiendas` WHERE ID = '$id'";
		    $resultado = $conn->query($sql);

		    return $resultado;
	    }
        
    static function mostrarTiendas(){
        $tienda = self::filtrarTienda();
        return $tienda;
    }

    //Para busqueda y filtros

    static function buscarTienda($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM tiendas WHERE ID = '$id'";
        $tienda = array('ID', 'Nombre', 'Codigopostal', 'Provincia', 'Localidad', 'Direccion', 'Telefono', 'Horario');
        $result = $conn->query($query);
        if ($result != null){
            $resultado = $result->fetch_assoc();
            $tienda['ID'] = $id;
            $tienda['Nombre'] = $resultado['Nombre'];
            $tienda['Codigopostal'] = $resultado['Codigopostal']; 
            $tienda['Provincia'] = $resultado['Provincia'];
            $tienda['Localidad'] = $resultado['Localidad'];
            $tienda['Direccion'] = $resultado['Direccion']; 
            $tienda['Telefono'] = $resultado['Telefono'];
            $tienda['Horario'] = $resultado['Horario'];
            return $tienda;
        }else{
            error_log("Error BD ({$conn->errno}):{$conn->error}");
        }

        return $tienda;
    }

    static function filtrarTienda(){
        $app = Aplicacion::getInstance();
        $conn = $app->getConexionBd();

        $localidad = $_SESSION['localidad'];
        $provincia= $_SESSION['provincia'];

        $condiciones = [];

        if (isset($localidad) && !empty($localidad)){
            $condiciones[] = "Localidad LIKE '$localidad'";
        }
        if (isset($provincia) && !empty($provincia)){
            $condiciones[] = "Provincia LIKE '$provincia'";
        }

        $where = !empty($condiciones) ? ' where ' .implode(' AND ', $condiciones) : '';
        $sql = "SELECT * FROM tiendas " . $where;

        $resultado = $conn->query($sql);
        $tienda = [];
        $i = 0;

        if($resultado != null) {
            foreach ($resultado as $fila) {
                $tienda[$i] = $fila;
                $i++;
            }       
        }

        return $tienda;     
    }

    
}