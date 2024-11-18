<?php
require_once __DIR__."/includes/config.php";

use es\ucm\fdi\aw\FormularioDarAdmin as FormularioDarAdmin;

$tituloPagina = 'Dar administrador';

$contenidoPrincipal = '';

if (! isset($_SESSION['esAdmin']) || !$_SESSION['esAdmin']) {
	header("Location:index.php");
}
else {
	$formDarAdmin = new FormularioDarAdmin();
	$htmlForm = $formDarAdmin->gestiona();

    $contenidoPrincipal = <<<EOS
	<h1>Gestión de usuarios</h1>
	$htmlForm
	EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';