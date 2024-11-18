<?php
require_once __DIR__."/includes/config.php";

use es\ucm\fdi\aw\FormularioBuscadorUsuario as FormularioBuscadorUsuario;

$tituloPagina = 'Gestión de usuarios';

$contenidoPrincipal = '';

if (! isset($_SESSION['esAdmin']) || !$_SESSION['esAdmin']) {
	header("Location:index.php");
}
else {
	$formBuscUsuario = new FormularioBuscadorUsuario();
	$htmlForm = $formBuscUsuario->gestiona();

    $contenidoPrincipal = <<<EOS
	<h1>Gestión de usuarios</h1>
	$htmlForm
	EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
