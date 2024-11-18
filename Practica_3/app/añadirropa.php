<?php
require_once 'includes/config.php';
use es\ucm\fdi\aw\FormularioAñadirRopa as FormularioAñadirRopa;

$tituloPagina = 'Registro';

$contenidoPrincipal = '';

if (! isset($_SESSION['esAdmin']) || !$_SESSION['esAdmin']) {
	header("Location:index.php");
}
else {
    $formReg = new FormularioAñadirRopa();
    $htmlForm = $formReg->gestiona();

    $contenidoPrincipal=<<<EOS
        <h1>Registro a la Página Web</h1>
        $htmlForm;
    EOS;

    require __DIR__.'/includes/vistas/plantillas/plantilla.php';
}
?>