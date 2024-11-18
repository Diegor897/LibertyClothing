<?php
require_once 'includes/config.php';
use es\ucm\fdi\aw\FormularioRegistro as FormularioRegistro;

$tituloPagina = 'Registro';

$formReg = new FormularioRegistro();
$htmlForm = $formReg->gestiona();

$contenidoPrincipal=<<<EOS
    <h1>Registro a la Página Web</h1>
    $htmlForm;
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';

?>