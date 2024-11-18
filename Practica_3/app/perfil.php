<?php
require_once __DIR__.'/includes/config.php';

use es\ucm\fdi\aw\Aplicacion as Aplicacion;
use es\ucm\fdi\aw\FormularioEditarPerfil as FormularioEditarPerfil;
use es\ucm\fdi\aw\Usuario as Usuario;

$tituloPagina = 'Mi perfil';

$formEdit = new FormularioEditarPerfil();
$htmlForm = $formEdit->gestiona();

$contenidoPrincipal=<<<EOS
<h1>Datos de mi perfil</h1>    

<div class="contenedor">
     $htmlForm   
</div>

EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';


?>