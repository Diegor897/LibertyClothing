<?php
require_once __DIR__."/includes/config.php";


$tituloPagina = 'Gestión de tiendas';

$contenidoPrincipal = '';

if (! isset($_SESSION['esAdmin']) || !$_SESSION['esAdmin']) {
	header("Location:index.php");
}
else {
    $contenidoPrincipal = <<<EOS
	<h1>Gestión de tiendas</h1>
	<p>Aquí estará el formulario para añadir y eliminar tiendas.</p>
	<div id="Boton de administracion">
	<form action='añadirtienda.php'>
		<button type='submit' name="submit" id="submit">Añadir tienda</button>
	</form>
	</div>
	<div id="Boton de administracion">
	<form action='eliminartienda.php'>
		<button type='submit' name="submit" id="submit">Eliminar tienda</button>
	</form>
	</div>
	EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
