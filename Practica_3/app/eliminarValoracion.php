<?php
require_once __DIR__ . "/includes/config.php";
use es\ucm\fdi\aw\Valoracion;


$userABorrar = $_POST["user"];
$idPABorrar = $_POST["idP"];

Valoracion::deleteValoracion($userABorrar, $idPABorrar);
if (! isset($_SESSION['esAdmin']) || !$_SESSION['esAdmin']) {
	header("Location:producto.php?id=$idPABorrar");
}
else {
	header("Location:gestionValoraciones.php");
}