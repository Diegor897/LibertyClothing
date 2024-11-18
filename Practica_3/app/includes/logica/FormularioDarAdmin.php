<?php
namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as Aplicacion;
use es\ucm\fdi\aw\Formulario as Formulario;
use es\ucm\fdi\aw\Usuario as Usuario;

class FormularioDarAdmin extends Formulario {

    public function __construct() {
        parent::__construct('formDarAdmin', ['urlRedireccion' => 'administracion.php']);
    }

    protected function generaCamposFormulario(&$datos) {

        $usuario = Usuario::buscaUsuario($_REQUEST['nombreusuario']);

        $nombre = $usuario->getNombre();
        $user = $usuario->getNombreUsuario();
        $codPostal =  $usuario->getcodPostal();
        $direccion = $usuario->getdireccion();
        $imgPerfil = $usuario->getImagen();

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos([], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <div>
            <p> <label for="nombre"> Nombre </label>
                <input id='nombre' type='text' name='nombre' value='$nombre' readonly/> </p>
            </div>

            <div>
            <p>
                <label for="nombreUsuario"> Nombre Usuario </label>
                <input id="nombreUsuario" type="text" name="nombreUsuario" value='$user' readonly/> <p>
            </div>

            <div>
            <p>
                <label for="password"> Password </label>
                <input id="password" type="password" name="password"  value="********" readonly/> </p>
            </div> 

            <div>
            <p>
                <label for="direccion"> Dirección </label>
                <input id="direccion" type="text" name="direccion"  value='$direccion' readonly/> </p>
            </div>

            <div>
            <p>
                <label for="codPostal"> Código Postal </label>
                <input id="codPostal" type="text" name="codPostal" value='$codPostal' readonly/> </p>
            </div> 

            <div>
            <p>
                <label for="imgPerfil"> Imagen Perfil </label>
                <img class="img-logo" src='$imgPerfil'> </p>
            </div>

            <div>
                <button type="submit" name="Guardar">Dar permiso de administrador</button>
            </div>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {

        $usuario = Usuario::buscaUsuario($datos['nombreUsuario']);

        $result = Usuario::devuelveRoles($usuario);
        $esAdmin = in_array(Usuario::ADMIN_ROLE, $result->getRoles());

        if ($esAdmin) {
            $this->errores[] = "El usuario ya está registrado como administrador";
        }

        if (count($this->errores) === 0) {
            $result = Usuario::agregaRol($usuario, Usuario::ADMIN_ROLE);

            if ($result) {
                $result->añadeRol(Usuario::ADMIN_ROLE);
            }
        }
    }
}