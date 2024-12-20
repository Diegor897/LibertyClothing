<?php
namespace es\ucm\fdi\aw;


use es\ucm\fdi\aw\Formulario as Formulario;

class FormularioLocate extends Formulario {

    public function __construct() {
        parent::__construct('formLocate', ['urlRedireccion' => 'tiendas.php']);

        $_SESSION['localidad'] = "";
        $_SESSION['provincia'] = "";

    }

    protected function generaCamposFormulario(&$datos) {
        $busquedalocalidad = $datos['busquedalocalidad'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['busquedalocalidad'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales


        <label for="busquedalocalidad">Localidad:</label>
        <input type="text" id="busquedalocalidad" name="busquedalocalidad" value="$busquedalocalidad"/>
        {$erroresCampos['busquedalocalidad']}

        <label for="provincia">Provincia:</label>
        <select id="provincia" name="provincia">
            <option value="">Elige Provincia</option>
            <option value="Álava">Álava</option>
            <option value="Albacete">Albacete</option>
            <option value="Alicante">Alicante</option>
            <option value="Almería">Almería</option>
            <option value="Asturias">Asturias</option>
            <option value="Ávila">Ávila</option>
            <option value="Badajoz">Badajoz</option>
            <option value="Baleares">Baleares</option>
            <option value="Barcelona">Barcelona</option>
            <option value="Burgos">Burgos</option>
            <option value="Cáceres">Cáceres</option>
            <option value="Cádiz">Cádiz</option>
            <option value="Cantabria">Cantabria</option>
            <option value="Castellón">Castellón</option>
            <option value="Ceuta">Ceuta</option>
            <option value="Ciudad Real">Ciudad Real</option>
            <option value="Córdoba">Córdoba</option>
            <option value="Cuenca">Cuenca</option>
            <option value="Gerona">Gerona</option>
            <option value="Granada">Granada</option>
            <option value="Guadalajara">Guadalajara</option>
            <option value="Guipúzcoa">Guipúzcoa</option>
            <option value="Huelva">Huelva</option>
            <option value="Huesca">Huesca</option>
            <option value="Jaén">Jaén</option>
            <option value="La Coruña">La Coruña</option>
            <option value="La Rioja">La Rioja</option>
            <option value="Las Palmas">Las Palmas</option>
            <option value="León">León</option>
            <option value="Lérida">Lérida</option>
            <option value="Lugo">Lugo</option>
            <option value="Madrid">Madrid</option>
            <option value="Málaga">Málaga</option>
            <option value="Melilla">Melilla</option>
            <option value="Murcia">Murcia</option>
            <option value="Navarra">Navarra</option>
            <option value="Orense">Orense</option>
            <option value="Palencia">Palencia</option>
            <option value="Pontevedra">Pontevedra</option>
            <option value="Salamanca">Salamanca</option>
            <option value="Segovia">Segovia</option>
            <option value="Sevilla">Sevilla</option>
            <option value="Soria">Soria</option>
            <option value="Tarragona">Tarragona</option>
            <option value="Tenerife">Tenerife</option>
            <option value="Teruel">Teruel</option>
            <option value="Toledo">Toledo</option>
            <option value="Valencia">Valencia</option>
            <option value="Valladolid">Valladolid</option>
            <option value="Vizcaya">Vizcaya</option>
            <option value="Zamora">Zamora</option>
            <option value="Zaragoza">Zaragoza</option>
        </select>

        <button type="submit">Filtrar</button>
        EOF;

        return $html;

    }

    protected function procesaFormulario(&$datos) {

        $this->errores =[];


        $localidad = htmlspecialchars(trim($datos['busquedalocalidad'] ?? ''));
        //$localidad = filter_var($localidad, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $provincia = $datos['provincia'];


        if (count($this->errores) === 0) {

            $_SESSION['localidad'] = $localidad;
            $_SESSION['provincia'] = $provincia;
        }
    }

}