<?php
require_once 'includes/config.php';
use es\ucm\fdi\aw\Ropa as Ropa;
use es\ucm\fdi\aw\FormularioBuscador as FormularioBuscador;

$tituloPagina = 'Catalogo de ropa';

$ropa = Ropa::mostrarcatalogo();
$html = "";
if ($ropa != null) {
     foreach($ropa as $i){
         $id = $i["ID"];
         $nombre = $i["Nombre"]; 
         $descripcion = $i["Descripcion"];
         $stock = $i["Stock"];
         $precio = $i["Precio"];
         $categoria = $i["Categoria"];
         $talla = $i["Talla"];
         $color = $i["Color"];
         $imagen = $i["Imagen"];

         $html .= <<<EOF
         <a href="producto.php?id=$id">
         <div class="producto">
             <img alt=$descripcion src=$imagen>
             <h4>$nombre</h4>
             <h5>$categoria</h5>
             <h5>$talla</h5>
             <p>$descripcion</p>
             <p>$color</p>
             <p>$precio €</p>   
         </div>
          </a>
         EOF;
     }
}
else{
     $html = <<<EOF
          <h4>Catalogo vacío</h4>
     EOF;
}

$form = new FormularioBuscador();
$htmlFormBusc = $form->gestiona();

$contenidoPrincipal=<<<EOS
<h1>Catálogo de LibertyClothing</h1>    
<div class="barra-superior">
     <div class="buscador">
     $htmlFormBusc
     </div>
</div>
<div class="contenedor">
     <div class="catalogo">
     $html
     </div>      
</div>

<script type="text/javascript" src="carrito.js></script>

EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';