<?php
namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as Aplicacion;
use es\ucm\fdi\aw\Formulario as Formulario;
use es\ucm\fdi\aw\Ropa as Ropa;


class FormularioAñadirRopa extends Formulario{

    const EXTENSIONES_PERMITIDAS = array('jpg', 'jpe', 'jpeg', 'png');
    const PATHINFO_EXTENSION = 4;


    public function __construct(){
        parent::__construct('formañadiropa', ['urlredireccion'=>'administracion.php']);
    }

    protected function generaCamposFormulario(&$datos){

        $nombre = $datos['nombre'] ?? '';
        $stock = $datos['stock'] ?? '';
        $color = $datos['color'] ?? '';
        $categoria = $datos['categoria'] ?? '';
        $talla = $datos['talla'] ?? '';
        $descripcion = $datos['descripcion'] ?? '';
        $precio = $datos['precio'] ?? '';
        $stock = $datos['stock'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre', 'stock', 'color', 'categoria', 'talla', 'descripcion', 'precio'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Datos para añadir ropa</legend>
            <div>
                <label for="nombre">Nombre de ropa</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" />
                {$erroresCampos['nombre']}
            </div>
            <div>
                <label for="color">Color de la ropa</label>
                <input id="color" type="text" name="color" value="$color" />
                {$erroresCampos['color']}
            </div>
            <div>
                <label for="categoria">Categoria de ropa</label>
                <input id="categoria" type="text" name="categoria" value="$categoria" />
                {$erroresCampos['categoria']}
            </div>
            <div>
                <label for="talla">Talla de ropa</label>
                <input id="talla" type="text" name="talla" value="$talla" />
                {$erroresCampos['talla']}
            </div>
            <div>
                <label for="descripcion">Descripcion de ropa</label>
                <input id="descripcion" type="text" name="descripcion" value="$descripcion" />
                {$erroresCampos['descripcion']}
            </div>
            <div>
                <label for="precio">Precio de ropa</label>
                <input id="precio" type="text" name="precio" value="$precio" />
                {$erroresCampos['precio']}
            </div>
            <div>
                <label for="stock">Stock de ropa</label>
                <input id="stock" type="text" name="stock" value="$stock" />
                {$erroresCampos['stock']}
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

        $color = trim($datos['color'] ?? '');
        $color = filter_var($color, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $color || empty($color)) {
            $this->errores['color'] = 'El color no puede estar vacío';
        }

        $categoria = trim($datos['categoria'] ?? '');
        $categoria = filter_var($categoria, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $categoria || empty($categoria)) {
            $this->errores['categoria'] = 'La categoría no puede estar vacía';
        }

        $talla = trim($datos['talla'] ?? '');
        $talla = filter_var($talla, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $talla || empty($talla)) {
            $this->errores['talla'] = 'La talla no puede estar vacía.';
        }

        $descripcion = trim($datos['descripcion'] ?? '');
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $descripcion || empty($descripcion)) {
            $this->errores['descripcion'] = 'La descripcion no puede estar vacía.';
        }

        $precio = trim($datos['precio'] ?? '');
        $precio = filter_var($precio, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $precio || empty($precio) ) {
            $this->errores['precio'] = 'El precio no puede estar vacío.';
        }

        $stock = trim($datos['stock'] ?? '');
        $stock = filter_var($stock, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $stock || empty($stock) ) {
            $this->errores['stock'] = 'El stock no puede estar vacío.';
        }


        /*$imagen = $_FILES['imagen']['error'] == UPLOAD_ERR_OK && count($_FILES) == 1;
        if (!$imagen) {
            $this->errores['imagen'] = 'Error al subir el archivo';
            return;
        } 
        $ok = self::check_file_uploaded_name($nombre) && $this->check_file_uploaded_length($nombre);
        if (!$ok){
            $this->errores['imagen'] = 'La imagen no se ha subido correctamente';
        }

        $destination = __DIR__.'imagenes/'.$datos['imgPerfil']['nombre'];
        $extension = pathinfo($nombre, PATHINFO_EXTENSION);
        $ok = $ok && in_array($extension, self::EXTENSIONES_PERMITIDAS);       
        if (!$ok){
            $this->errores['imagen'] = 'Esa extension no esta permitida, por favor suba otro archivo';
        }
        
        if (is_file($destination)){
            $this->errores['imgPerfil'] = "Ya existe la foto de perfil, prueba con otra";
            unlink(ini_get('upload_tm_dir').$datos['imgPerfil']['tmp_name']);
            exit;
        }
        if (!move_uploaded_file($imagen, $destination)){
            $this->errores['imgPerfil'] = "No se ha podido mover la imagen a la carpeta de de destino";
            unlink(ini_get('upload_tm_dir').$datos['imgPerfil']['tmp_name']);
            exit;
        }
        */
        if (count($this->errores) === 0) {

            $ropa = Ropa::mismaropa($nombre);
            
            if($ropa){
                $this->errores[] = "La prenda ya esta registrada en la base de datos";
            }
            else{
                if (!Ropa::anadirRopa($nombre, $color, $categoria, $talla, $descripcion, $precio, $stock)){
                    $this->errores[] = "La prenda no ha podido ser insertada en la base de datos";
                }
            }
                
        }
    }
    //Este código pertenece al bitbucket que nos ha aportado el profesor de la asignatura Javier Agapito.
    //Los diferentes creadores de los scripts utilizados están reconocidos encima de sus correspondientes scripts
    /**
     * Check $_FILES[][name]
     *
     * @param (string) $filename - Uploaded file name.
     * @author Yousef Ismaeil Cliprz
     * @See http://php.net/manual/es/function.move-uploaded-file.php#111412
     */
    private static function check_file_uploaded_name($filename)
    {
        return (bool) ((mb_ereg_match('/^[0-9A-Z-_\.]+$/i', $filename) === 1) ? true : false);
    }

    /**
     * Sanitize $_FILES[][name]. Remove anything which isn't a word, whitespace, number
     * or any of the following caracters -_~,;[]().
     *
     * If you don't need to handle multi-byte characters you can use preg_replace
     * rather than mb_ereg_replace.
     * 
     * @param (string) $filename - Uploaded file name.
     * @author Sean Vieira
     * @see http://stackoverflow.com/a/2021729
     */
    private static function sanitize_file_uploaded_name($filename)
    {
        /* Remove anything which isn't a word, whitespace, number
     * or any of the following caracters -_~,;[]().
     * If you don't need to handle multi-byte characters
     * you can use preg_replace rather than mb_ereg_replace
     * Thanks @Łukasz Rysiak!
     */
        $newName = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $filename);
        // Remove any runs of periods (thanks falstro!)
        $newName = mb_ereg_replace("([\.]{2,})", '', $newName);

        return $newName;
    }

    /**
     * Check $_FILES[][name] length.
     *
     * @param (string) $filename - Uploaded file name.
     * @author Yousef Ismaeil Cliprz.
     * @See http://php.net/manual/es/function.move-uploaded-file.php#111412
     */
    private function check_file_uploaded_length($filename)
    {
        return (bool) ((mb_strlen($filename, 'UTF-8') < 250) ? true : false);
    }
    
}


?>
