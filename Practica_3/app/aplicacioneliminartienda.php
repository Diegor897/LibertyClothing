<?php
require_once __DIR__ . "/includes/config.php";
use es\ucm\fdi\aw\Tienda;


$idPABorrar = $_POST["id"];

Tienda::eliminartienda($idPABorrar);
header("Location:gestionTiendas.php");