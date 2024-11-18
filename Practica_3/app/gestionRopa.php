<?php
require_once __DIR__."/includes/config.php";


$tituloPagina = 'Gestión de ropa';

$contenidoPrincipal = '';

if (! isset($_SESSION['esAdmin']) || !$_SESSION['esAdmin']) {
	header("Location:index.php");
}
else {
    $contenidoPrincipal = <<<EOS
	<h1>Gestión de ropa</h1>
	<p>Aquí estará el formulario para añadir, eliminar y editar ropa</p>
	<div id="Boton de administracion">
	<form action='añadirropa.php'>
		<button type='submit' name="submit" id="submit">Añadir ropa</button>
	</form>
	</div>
	<div id="Boton de administracion">
	<form action='eliminarropa.php'>
		<button type='submit' name="submit" id="submit">Eliminar ropa</button>
	</form>
	</div>
	EOS;
}
require __DIR__.'/includes/vistas/plantillas/plantilla.php';
