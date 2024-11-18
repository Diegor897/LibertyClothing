<!DOCTYPE html>
<html lang='es'>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS ?>/estilo.css" />
	<title><?= $tituloPagina ?></title>
</head>
<body>
<div id="contenedor">

<?php require('includes/vistas/comun/cabecera.php');?>

<?= $contenidoPrincipal ?>

<?php require('includes/vistas/comun/footer.php');?>

</div>
</body>
</html>