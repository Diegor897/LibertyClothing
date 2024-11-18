<?php
namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as Aplicacion;
use es\ucm\fdi\aw\Formulario as Formulario;
use es\ucm\fdi\aw\Usuario as Usuario;

class FormularioEditarPerfil extends Formulario {

    public function __construct() {
        parent::__construct('formEditarPerfil', ['urlRedireccion' => 'index.php']);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        //Datos de la sesion

        $nombre = $_SESSION['nombre'];
        $user = $_SESSION['nombreusuario'];
        $pass = $_SESSION['password'];
        $codPostal =  $_SESSION['codPostal'];
        $direccion = $_SESSION['direccion'];
        $imgPerfil = $_SESSION['imgPerfil'];

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombreUsuario', 'nombre',  'password','direccion', 'codPostal','imgPerfil'], 
                                                    $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <div>
            <p> <label for="nombre"> Nombre </label>
                <input id='nombre' type='text' name='nombre'  placeholder='$nombre'> </p>
                {$erroresCampos['nombre']}
            </div>

            <div>
            <p>
                <label for="nombreUsuario"> Nombre Usuario </label>
                <input id="nombreUsuario" type="text" name="nombreUsuario"  placeholder='$user'/> <p>
                {$erroresCampos['nombreUsuario']}
            </div>

            <div>
            <p>
                <label for="password"> Password Nueva </label>
                <input id="password_nueva" type="password" name="password_nueva"  placeholder="********" required /> </p>
                {$erroresCampos['password']}
            </div> 

            <div>
            <p>
                <label for="direccion"> Dirección </label>
                <input id="direccion" type="text" name="direccion"  placeholder='$direccion'/> </p>
                {$erroresCampos['direccion']}
            </div>

            <div>
            <p>
                <label for="codPostal"> Código Postal </label>
                <input id="codPostal" type="text" name="codPostal" placeholder='$codPostal' /> </p>
                {$erroresCampos['codPostal']}
            </div> 

            <div>
            <p>
                <label for="imgPerfil"> Imagen Perfil </label>
                <img class="img-logo" src='$imgPerfil'> 
                
                <form action="#" method="get" enctype="multipart/form-data">
                    <input type="file" name="imgPerfil" />
                    <input type="submit" value="Guardar">
                </form> </p>
            </div>
            <div>
                <button type="submit" name="editar">Editar</button>
            </div>
        </fieldset>
        EOF;
        return $html;
    }

    /*
     
        */


    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$nombre || empty($nombre) ) {
            $nombre = $_SESSION['nombre'];
        }
        
        $nombreUsuario = trim($datos['nombreUsuario'] ?? '');
        $nombreUsuario = filter_var($nombreUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$nombreUsuario || empty($nombreUsuario)) {
            $nombreUsuario = $_SESSION['nombreusuario'];
        }
      
        $password_nueva = trim($datos['password_nueva'] ?? '');
       

        $direccion = trim($datos['direccion'] ?? '');
        $direccion = filter_var($direccion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$direccion || empty($direccion) ) {
           $direccion = $_SESSION['direccion'];
        }

        $codPostal = trim($datos['codPostal'] ?? '');
        $codPostal = filter_var($codPostal, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$codPostal || empty($codPostal) ) {
           $codPostal = $_SESSION['codPostal'];
        }

        /*
        if (!is_uploaded_file($datos['imgPerfil']['tmp-name'])){
            $this->errores['imgPerfil'] = "El fichero de imagen no se ha subido correctamente";
        }
        $imgPerfil = $datos['imgPerfil']['tmp_name'];
        $destination = __DIR__.'imagenes/'.$datos['imgPerfil']['nombre'];
        if (is_file($destination)){
            $this->errores['imgPerfil'] = "Ya existe la foto de perfil, prueba con otra";
            unlink(ini_get('upload_tm_dir').$datos['imgPerfil']['tmp_name']);
            exit;
        }
        if (!move_uploaded_file($imgPerfil, $destination)){
            $this->errores['imgPerfil'] = "No se ha podido mover la imagen a la carpeta de de destino";
            unlink(ini_get('upload_tm_dir').$datos['imgPerfil']['tmp_name']);
            exit;
        }
        */

        
        if (count($this->errores) === 0) {
            $usuario = Usuario::editarDatos($_SESSION['email'], $nombreUsuario,$nombre,$direccion,$codPostal, $password_nueva,"");
        
            if (!$usuario) {
                $this->errores[] = "Error al editar los datos";
            } else {
                $_SESSION['nombre'] = $nombre;
                $_SESSION['nombreusuario'] = $nombreUsuario;
                $_SESSION['codPostal'] = $codPostal;
                $_SESSION['direccion'] = $direccion;
                $_SESSION['password'] = $password_nueva; 
                //$_SESSION['imgPerfil'] = $imgPerfil; 
            }
        }
    }
}
