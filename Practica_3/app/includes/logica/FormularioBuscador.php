<?php
namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Formulario as Formulario;

class FormularioBuscador extends Formulario {

    public function __construct() {
        parent::__construct('formBusqueda', ['urlRedireccion' => 'catalogo.php']);

        $_SESSION['busqueda'] = "";
        $_SESSION['categoria'] = "";
        $_SESSION['precio'] = "";
        $_SESSION['color'] = "";
        $_SESSION['talla'] = "";
        
    }

    protected function generaCamposFormulario(&$datos) {
        $busqueda = $datos['busqueda'] ?? '';
        $precio = $datos['precio'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['busqueda', 'precio'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
        <label for="busqueda">Buscar:</label>
        <input type="busqueda" id="busqueda" name="busqueda" value="$busqueda"/>
        {$erroresCampos['busqueda']}

        <label for="categoria">Categoría:</label>
        <select id="categoria" name="categoria">
        <option value="">Todas las categorías</option>
        <option value="Camisas">Camisas</option>
        <option value="Sudaderas">Sudaderas</option>
        <option value="Jerseys">Jerseys</option>
        <option value="Vestidos">Vestidos</option>
        <option value="Camisetas">Camisetas</option>
        <option value="Zapatos">Zapatos</option>
        <option value="Accesorios">Accesorios</option>
        <option value="Pantalones">Pantalones</option>
        </select>

        <label for="precio">Precio máximo:</label>
        <input type="number"  id="precio" min="0" name="precio" value="$precio" />
        {$erroresCampos['precio']}

        <label for="color">Color:</label>
        <select id="color" name="color">
        <option value="">Todos los colores</option>
        <option value="negro">Negro</option>
        <option value="blanco">Blanco</option>
        <option value="amarillo">Amarillo</option>
        <option value="verde">Verde</option>
        <option value="azul">Azul</option>
        </select>

        <label for="talla">Talla:</label>
        <select id="talla" name="talla">
        <option value="">Todas las  tallas</option>
        <option value="XS">XS</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        </select>

        <button type="submit">Filtrar</button>
EOF;

        return $html;

    }

    protected function procesaFormulario(&$datos) {

        $this->errores =[];

        $busqueda = trim($datos['busqueda'] ?? '');
        $busqueda = filter_var($busqueda, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $categoria = trim($datos['categoria'] ?? '');
        $categoria = filter_var($categoria, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $precio = trim($datos['precio'] ?? '');
        $precio = filter_var($precio, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ( $precio && $precio < 0 ) {
            $this->errores['precio'] = 'El precio no puede ser negativo';
        }

        $color = trim($datos['color'] ?? '');
        $color = filter_var($color, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $talla = trim($datos['talla'] ?? '');
        $talla = filter_var($talla, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (count($this->errores) === 0) {

            $_SESSION['busqueda'] = $busqueda;
            $_SESSION['categoria'] = $categoria;
            $_SESSION['precio'] = $precio;
            $_SESSION['color'] = $color;
            $_SESSION['talla'] = $talla;
        }
    }
}