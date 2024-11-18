<?php
namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as Aplicacion;
use es\ucm\fdi\aw\Formulario as Formulario;
use es\ucm\fdi\aw\Tienda as Tienda;


class FormularioAñadirTienda extends Formulario{


    public function __construct(){
        parent::__construct('formañaditienda', ['urlredireccion'=>'administracion.php']);
    }

    protected function generaCamposFormulario(&$datos){

        $nombre = $datos['nombre'] ?? '';
        $codigopostal = $datos['codigopostal'] ?? '';
        $provincia = $datos['provincia'] ?? '';
        $localidad = $datos['localidad'] ?? '';
        $direccion = $datos['direccion'] ?? '';
        $telefono = $datos['telefono'] ?? '';
        $horario = $datos['horario'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre', 'codigopostal', 'provincia', 'localidad', 'direccion', 'telefono', 'horario'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Datos para añadir ropa</legend>
            <div>
                <label for="nombre">Nombre de tienda</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" />
                {$erroresCampos['nombre']}
            </div>
            <div>
                <label for="codigopostal">Codigo postal</label>
                <input id="codigopostal" type="text" name="codigopostal" value="$codigopostal" />
                {$erroresCampos['codigopostal']}
            </div>
            <div>
                <label for="provincia">Provincia</label>
                <input id="provincia" type="text" name="provincia" value="$provincia" />
                {$erroresCampos['provincia']}
            </div>
            <div>
                <label for="localidad">Localidad</label>
                <input id="localidad" type="text" name="localidad" value="$localidad" />
                {$erroresCampos['localidad']}
            </div>
            <div>
                <label for="descripcion">Dirección</label>
                <input id="direccion" type="text" name="direccion" value="$direccion" />
                {$erroresCampos['direccion']}
            </div>
            <div>
                <label for="telefono">Teléfono</label>
                <input id="telefono" type="text" name="telefono" value="$telefono" />
                {$erroresCampos['telefono']}
            </div>
            <div>
                <label for="horario">Horario</label>
                <input id="horario" type="text" name="horario" value="$horario" />
                {$erroresCampos['horario']}
            </div>
            <button type="submit" name="añadirropa">Añadir</button>
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

        $codigopostal = trim($datos['codigopostal'] ?? '');
        $codigopostal = filter_var($codigopostal, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $codigopostal || empty($codigopostal)) {
            $this->errores['codigopostal'] = 'El codigopostal no puede estar vacío';
        }

        $provincia = trim($datos['provincia'] ?? '');
        $provincia = filter_var($provincia, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $provincia || empty($provincia)) {
            $this->errores['provincia'] = 'La provincia no puede estar vacía';
        }

        $localidad = trim($datos['localidad'] ?? '');
        $localidad = filter_var($localidad, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $localidad || empty($localidad)) {
            $this->errores['localidad'] = 'La localidad no puede estar vacía.';
        }

        $direccion = trim($datos['direccion'] ?? '');
        $direccion = filter_var($direccion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $direccion || empty($direccion)) {
            $this->errores['direccion'] = 'La direccion no puede estar vacía.';
        }

        $telefono = trim($datos['telefono'] ?? '');
        $telefono = filter_var($telefono, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $telefono || empty($telefono) ) {
            $this->errores['telefono'] = 'El telefono no puede estar vacío.';
        }

        $horario = trim($datos['horario'] ?? '');
        $horario = filter_var($horario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $horario || empty($horario) ) {
            $this->errores['horario'] = 'El horario no puede estar vacío.';
        }

        if (count($this->errores) === 0) {

            $tienda = Tienda::mismatienda($localidad);
            
            if($tienda){
                $this->errores[] = "La tienda ya esta registrada en la base de datos";
            }
            else{
                if (!Tienda::anadirTienda($nombre, $codigopostal, $provincia, $localidad, $direccion, $telefono, $horario)){
                    $this->errores[] = "La tienda no ha podido ser insertada en la base de datos";
                }
            }
                
        }
    }
}


?>