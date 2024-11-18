<?php
require_once 'includes/config.php';
use es\ucm\fdi\aw\Usuario;
require_once __DIR__."/includes/logica/FormularioValoracion.php";
use es\ucm\fdi\aw\Ropa;
use es\ucm\fdi\aw\Valoracion;

$tituloPagina='Formulario valoracion';
$ropa = Ropa::mostrarproducto($_REQUEST["id"]);
    $id = $ropa["ID"];
    $nombre = $ropa["Nombre"];
    $descripcion = $ropa["Descripcion"];
    $stock = $ropa["Stock"];
    $precio = $ropa["Precio"];
    $categoria = $ropa["Categoria"];
    $talla = $ropa["Talla"];
    $color = $ropa["Color"];
    $imagen = $ropa["Imagen"];

$elimina= "";
$modo = "";
$reportador = $_SESSION['nombre'];
$val = Valoracion::getValoracion($reportador,$id);
if ($val != null) {
    $modo .= "Edita";
    $elimina .= <<<EOS
                <form action='eliminarValoracion.php' method="POST">
                    <input type="hidden" name= "user" value= $reportador>
                    <input type="hidden" name= "idP" value= $id>
                    <button type='submit'>Eliminar valoración</button>
                </form>
                EOS;
    $form = buildReviewForm($id, $val->getTitulo(), $val->getDescripcion(), $val->getEstrelllas());
}
else{
    $modo .= "Nueva";
    $form = buildReviewForm($id, "", "");
}

$contenidoPrincipal=<<<EOS
    <h1>$modo valoración del producto</h1>
    <div class="formularioValoracion-seccion">Ficha de producto</div>
        <div class="producto">
        <img alt=$descripcion src=$imagen>
        <h4>$nombre</h4>
        <h5>$categoria</h5>
        <h5>$talla</h5>
        <p>$descripcion</p>
        <p>$color</p>
        <p>$precio €</p>
        </div>
    $form $elimina
EOS;
require __DIR__.'/includes/vistas/plantillas/plantilla.php';