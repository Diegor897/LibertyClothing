<?php
require_once "includes/config.php";

$tituloPagina = "Página Principal";

$contenidoPrincipal = <<<EOS
	<h2>Página Principal Liberty Clothing</h2>
	<p>Bienvenido a la página principal de Liberty Clothing, aqui podrás ver las últimas novedades en ropa y accesorios disponibles en nuestras tiendas.</p>
	<br>
	<h3>Catálogo</h3>
	<p>Consulta el catálogo para explorar la gran variedad de prendas que ofrecemos a nuestros consumidores</p>
	<br>
	<h3>Valoraciones</h3>
	<p>Da tu opinion sobre tus prendas favoritas y interactúa con el resto de usuarios sobre cuales forman los mejores conjuntos.</p>
EOS;

require_once __DIR__."/includes/vistas/plantillas/plantilla.php";


?>