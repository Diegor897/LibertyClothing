<?php
namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as Aplicacion;
use es\ucm\fdi\aw\Formulario as Formulario;
use es\ucm\fdi\aw\Ropa as Ropa;


class FormularioEliminarRopa extends Formulario{


    public function __construct(){
        parent::__construct('formeliminarropa', ['urlredireccion'=>'administracion.php']);
    }

    protected function generaCamposFormulario(&$datos){

        $nombre = $datos['nombre'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Datos para eliminar ropa</legend>
            <div>
                <label for="nombre">Nombre de ropa</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" />
                {$erroresCampos['nombre']}
            </div>
            <button type="submit" name="eliminarropa">Eliminar</button>
        EOF;
        return $html;
    }
    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombre || empty($nombre) ) {
            $this->errores['nombre'] = 'El nombre no pudee estar vacío.';
        }

        if (count($this->errores) === 0) {

            $ropa = Ropa::mismaropa($nombre);
            
            if($ropa){
                if (!Ropa::eliminarropa($nombre)){
                    $this->errores[] = "La prenda no ha podido ser insertada en la base de datos";
                }
                
            }
            else{
                
                
            }
            else{
                $this->errores[] = "La prenda que intenta eliminar no existe";
            }
                
        }
    }
}