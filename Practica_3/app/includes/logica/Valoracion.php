<?php
    namespace es\ucm\fdi\aw;

    use es\ucm\fdi\aw\Aplicacion as Aplicacion;
    class Valoracion{

        private $titulo;
        private $descripcion;
        private $idProducto;
        private $reportador;
        private $fechaValoracion;
        private $megustas;
        private $estrellas;

        function __construct($descripcion ="",$estrellas = "", $titulo ="", $idProducto ="", $reportador="", $fechaValoracion="", $megustas="")
        {
            $this->descripcion = $descripcion;
            $this->titulo = $titulo;
            $this->idProducto = $idProducto;
            $this->reportador = $reportador;
            $this->fechaValoracion = $fechaValoracion;
            $this->megustas = $megustas;
            $this->estrellas = $estrellas;
        }

        public function newValoracion()
        {
            $app = Aplicacion::getInstance();
            $conn = $app->getConexionBd();

            $sql = "INSERT INTO valoraciones(NombreUsuario,idProducto,Titulo,Descripción,Estrellas,Fecha,MeGustas)
            VALUES ('$this->reportador', '$this->idProducto', '$this->titulo', '$this->descripcion', '$this->estrellas', '$this->fechaValoracion', '$this->megustas')";
            $ok = $conn->query($sql);
            return $ok;
        }

        public static function getValoracion($nombre, $idProducto)
        {
            $app = Aplicacion::getInstance();
            $conn = $app->getConexionBd();
            $Valoracion = null;

            $sql = "SELECT * FROM valoraciones WHERE NombreUsuario = '$nombre' AND idProducto = '$idProducto'";
            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    $Valoracion = new Valoracion();
                    $Valoracion->createValoracion($resultado->fetch_assoc()); //Creamos un objeto Producto con los datos de la consulta
                }
            }
            return $Valoracion;
        }

        public static function showAllReports()
	    {
		    $app = Aplicacion::getInstance();
		    $conn = $app->getConexionBd();
		    $vals = [];
		    $i = 0;
		    $sql = "SELECT * FROM valoraciones";

		    if ($resultado = $conn->query($sql)) {
			    if ($resultado->num_rows > 0) {
				    while ($fila = $resultado->fetch_assoc()) {
					    $vals[$i] = $fila;
					    $i++;
				    }
			    }
		    }
		    return $vals;
	    }
	    public static function showReports($id)
        {
            $app = Aplicacion::getInstance();
            $conn = $app->getConexionBd();
            $vals = [];
            $i = 0;
            $sql = "SELECT * FROM valoraciones WHERE idProducto = $id";

           if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()) {
                        $vals[$i] = $fila;
                        $i++;
                    }
                }
           }
           return $vals;
        }

	    public static function deleteValoracion($user, $idP)
	    {
		    $app = Aplicacion::getInstance();
		    $conn = $app->getConexionBd();

		    $sql = "DELETE FROM `valoraciones` WHERE NombreUsuario = '$user' AND idProducto = '$idP'";
		    $resultado = $conn->query($sql);

		    return $resultado;
	    }

        public function updateValoracion($desc,$estrellas, $titulo,$fechaValoracion)
        {
            $app = Aplicacion::getInstance();
            $conn = $app->getConexionBd();

            $sql = "UPDATE valoraciones SET Titulo = '$titulo', Descripción = '$desc', Estrellas = '$estrellas', Fecha = '$fechaValoracion' WHERE NombreUsuario = '$this->reportador' AND idProducto = '$this->idProducto'";
            $resultado = $conn->query($sql);

            return $resultado;
        }

        public function createValoracion($row)
        {
            $this->descripcion = $row['Descripción'];
            $this->titulo = $row['Titulo'];
            $this->estrellas = $row['Estrellas'];
            $this->idProducto = $row['idProducto'];
            $this->reportador = $row['NombreUsuario'];
            $this->fechaValoracion = $row['Fecha'];
            $this->megustas = $row['MeGustas'];

        }

        public function getTitulo(){
            return $this->titulo;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }
        public function getEstrelllas()
        {
            return $this->estrellas;
        }
    }
