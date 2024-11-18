<?php
require_once __DIR__."/includes/config.php";


$tituloPagina = 'Administración';

$contenidoPrincipal = '';

if (! isset($_SESSION['esAdmin']) || !$_SESSION['esAdmin']) {
	header("Location:index.php");
} 
else {
	$contenidoPrincipal .= <<<EOS
	<h1>Consola de administración</h1>
	<form action='gestionUsuarios.php'>
		<button type='submit' name="submit" id="submit">Gestión de usuarios</button>
	</form>
	<form action='gestionValoraciones.php'>
		<button type='submit'>Gestión de valoraciones</button>
	</form>
	<form action='gestionTiendas.php'>
		<button type='submit'>Gestión de tiendas</button>
	</form>
	<form action='gestionRopa.php'>
		<button type='submit'>Gestión de ropa</button>
	</form>	
	EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
