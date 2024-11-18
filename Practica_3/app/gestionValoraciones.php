<?php
require_once __DIR__."/includes/config.php";
use es\ucm\fdi\aw\Valoracion;


$tituloPagina = 'Gestión de valoraciones';

$contenidoPrincipal = '';
$valoraciones = "";

if (! isset($_SESSION['esAdmin']) || !$_SESSION['esAdmin']) {
	header("Location:index.php");
}
else {
	$vals = Valoracion::showAllReports();
	if ($vals != null) {
		foreach ($vals as $v) {
			$nombre = $v['NombreUsuario'];
			$tit = $v['Titulo'];
			$desc = $v['Descripción'];
			$starsSel = $v['Estrellas'];
			$mg = $v['MeGustas'];
			$fecha = $v['Fecha'];
			$idP = $v['idProducto'];

			$valoraciones .= <<<EOF
            <div class="valoracion">
                <h2>$tit</h2>
                <h4>$nombre</h4>
                <div class="estrellas"><span class="sel sel-$starsSel"></span></div>
                <p>$desc</p>
                <div class= "fecha">$fecha</div><form action='eliminarValoracion.php' method="POST"><input type="hidden" name= "user" value= $nombre><input type="hidden" name= "idP" value= $idP><button type='submit'>Eliminar valoración</button></form>
            </div>
            EOF;
		}
	} else {
		$valoraciones = <<<EOF
            <h4>No hay valoraciones del producto</h4>
        EOF;
	}
    $contenidoPrincipal = <<<EOF
	<h1>Gestión de valoraciones</h1>
	<form action='catalogo.php'><button type='submit' name="submit" id="submit">Añadir valoración</button></form>
	<hr class="divVal">
	$valoraciones
	EOF;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
