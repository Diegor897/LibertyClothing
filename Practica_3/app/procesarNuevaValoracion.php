<?php
    require_once 'includes/config.php';
    use es\ucm\fdi\aw\Valoracion;
    require_once 'includes/logica/FormularioValoracion.php';

    $tituloPagina = 'Nueva valoración';
    $salida;
    
    if(isset( $_SESSION['login'])){
        $reportador = $_SESSION['nombre'];
        $titulo = htmlspecialchars(trim(strip_tags($_POST["titulo"])));
        $desc = htmlspecialchars(trim(strip_tags($_POST["desc"])));
        if(isset($_POST["estrellas"])){
            $estrellas = $_POST["estrellas"];
        }
        else {
            $estrellas = 0;
        }

        $idProducto = $_POST["idProducto"];
        $fechaValoracion = date("G").":".date("i").":".date("s")."-".date("d")."/".date("m")."/".date("Y");
        $megustas = 0;
    
    
        $val = Valoracion::getValoracion($reportador,$idProducto);

        if ($val != null){
            if($val->updateValoracion($desc,$estrellas, $titulo,$fechaValoracion)){
                $salida = "<h2>Su valoración se ha actualizado.</h2>";
            }
            else{
                 $salida = "<h2>ERROR: Su valoración no se ha actualizado.</h2>";
            }
        }
        else{ 
            $val = new Valoracion($desc,$estrellas, $titulo, $idProducto, $reportador, $fechaValoracion, $megustas);
            $ok = $val->newValoracion();
            if($ok){
                $salida = "<h2>Su valoración del producto se ha añadido correctamente.</h2>";
            }
            else{
                $salida = "<h2>ERROR: Su valoración no se ha podido añadir.</h2>";
            }
        }
    }
    else{
        $salida = "<div>Necesita iniciar sesión para valorar un producto.</div>";
    }

 $contenidoPrincipal = <<<EOS
        $salida
        <a href = "producto.php?id=$idProducto">Volver al producto</a>
EOS;
require __DIR__.'/includes/vistas/plantillas/plantilla.php';

