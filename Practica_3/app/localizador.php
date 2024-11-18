<?php
require_once __DIR__."/includes/config.php";
use es\ucm\fdi\aw\FormularioLocate as FormularioLocate;

$tituloPagina = 'Localización';

$formLoc = new FormularioLocate();
$htmlFormLogin = $formLoc->gestiona();

$contenidoPrincipal=<<<EOS
    <h1>Acceso al sistema</h1>
    $htmlFormLogin
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';