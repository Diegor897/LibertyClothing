<?php

require_once 'includes/config.php';
use es\ucm\fdi\aw\Ropa;
use es\ucm\fdi\aw\Valoracion;


$tituloPagina = "Vista producto";

$ropa = Ropa::mostrarproducto($_REQUEST["id"]);
if ($ropa != null){
    $id = $ropa["ID"];
    $nombre = $ropa["Nombre"];
    $descripcion = $ropa["Descripcion"];
    $stock = $ropa["Stock"];
    $precio = $ropa["Precio"];
    $categoria = $ropa["Categoria"];
    $talla = $ropa["Talla"];
    $color = $ropa["Color"];
    $imagen = $ropa["Imagen"];
    $vals = Valoracion::showReports($id);
    $valoraciones = "";
    if ($vals != null) {
        foreach($vals as $v){
            $nombre = $v['NombreUsuario'];
            $tit =$v['Titulo'];
            $desc =$v['Descripción'];
            $starsSel = $v['Estrellas'];
            $mg = $v['MeGustas'];
            $fecha = $v['Fecha'];

			$valoraciones .= <<<EOF
            <div class="valoracion">
                <h2>$tit</h2>
                <h4>$nombre</h4>
                <div class="estrellas"><span class="sel sel-$starsSel"></span></div>
                <p>$desc</p>
                <div class= "fecha">$fecha</div>
            </div>
            EOF;
		}
    }
    else {
        $valoraciones = <<<EOF
            <h4>No hay valoraciones del producto</h4>
        EOF;
}


    $contenidoPrincipal = <<<EOF
    <div class="producto">
        <img alt=$descripcion src=$imagen>
        <h4>$nombre</h4>
        <h5>$categoria</h5>
        <h5>$talla</h5>
        <p>$descripcion</p>
        <p>$color</p>
        <p>$precio €</p>
        <p> Quedan $stock</p>


        <form method="post" action="agregarCarrito.php">
            <input type="hidden" name="id" value="$id">
            <button type="submit" class="btn btn-primary">Añadir al carrito</button>
        </form>

        <a href="nuevaValoracion.php?id=$id">Valorar producto</a>

        <hr class="divVal" >
        $valoraciones
    </div>
    EOF;

}else{
    $contenidoPrincipal =<<<EOF
        <h4>Producto no visible</h4>
        <p>Ha ocurrido un problema y no le podemos mostrar la información del producto</p>
    EOF;
}



require_once __DIR__.'/includes/vistas/plantillas/plantilla.php';