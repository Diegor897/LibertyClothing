<?php
require_once __DIR__."/includes/config.php";
use es\ucm\fdi\aw\Tienda;


$tituloPagina = 'Gestión de eliminar tiendas';

$contenidoPrincipal = '';
$tiendas = "";

if (! isset($_SESSION['esAdmin']) || !$_SESSION['esAdmin']) {
	header("Location:index.php");
}
else {
	$tienda = Tienda::mostrarTiendas();
	if ($tienda != null) {
		foreach ($tienda as $v) {
            $id = $v['ID'];
			$nombre = $v['Nombre'];
			$codigopostal = $v['Codigopostal'];
			$provincia = $v['Provincia'];
			$localidad = $v['Localidad'];
			$direccion = $v['Direccion'];
			$telefono = $v['Telefono'];
			$horario = $v['Horario'];

			$tiendas.= <<<EOF
            <div class="tienda">
                <h3>$provincia</h3>
                <h5>$codigopostal</h5>
                <h4>$localidad</h4>
                <p>Dir: $direccion</p>
                <p>Tel: $telefono</p>
                <p>Horario: $horario</p> 
               <form action='aplicacioneliminartienda.php' method="POST"><input type="hidden" name= "id" value= $id><button type='submit'>Eliminar tienda</button></form>
            </div>
            EOF;
		}
	} else {
		$tiendas = <<<EOF
            <h4>No hay valoraciones del producto</h4>
        EOF;
	}
    $contenidoPrincipal = <<<EOF
	<h1>Gestión de tiendas</h1> <div class="contenedor"><div class="catalogo">$tiendas</div></div>
	EOF;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';