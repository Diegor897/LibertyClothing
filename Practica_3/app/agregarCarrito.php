<?php
require_once 'includes/config.php';

use es\ucm\fdi\aw\Usuario;
use es\ucm\fdi\aw\Ropa;
use es\ucm\fdi\aw\Valoracion;

$tituloPagina='Carrito';

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

    $modo = "";
    //$reportador = $_SESSION['nombre'];
   // $val = Valoracion::getValoracion($reportador,$id);
} 
$contenidoPrincipal=<<<EOS
    <h1>$modo Carrito </h1>

    <div class="CarritoUsuario">Artículos</div>

    <div class="container-icon">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="icon-cart"
        >
            <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
            />
        </svg>
        <div class="contador-productos">
        <h3>Productos en carrito:</h3>
        <span id="contador-productos">0</span>
    </div>

    <div class="container-cart-products hidden-cart">
        <div class="ropa-carrito">
            <div class="info-ropa-carrito">
                <span class="cantidad-ropa-carrito">1</span>
                <p class="titulo-ropa-carrito">$nombre</p>
                <span class="precio-precio-carrito">$precio €</span>
            </div>
            <div class="total">
                <h3>Total:</h3>
                <span class="total-pagar">$precio €</span>
            </div>
        </div>
    </div>
</div>

EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';


/*Esta parte del código 
    <div class="container-icon">
		<svg
			xmlns="http://www.w3.org/2000/svg"
			fill="none"
			viewBox="0 0 24 24"
			stroke-width="1.5"
			stroke="currentColor"
			class="icon-cart"
		>
		    <path
			stroke-linecap="round"
			stroke-linejoin="round"
			d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
			/>
		</svg>

está extraída de: https://github.com/roberto-aq/Tienda-online-Layout-html-y-css/blob/main/index.html*/

?>