<?php
require_once __DIR__."/includes/config.php";

use es\ucm\fdi\aw\Tienda as Tienda;
use es\ucm\fdi\aw\FormularioLocate as FormularioLocate;

$tituloPagina = 'Buscador de tiendas';

$tienda=Tienda::mostrarTiendas();
$html = "";
if ($tienda != null) {
     foreach($tienda as $i){
         $id = $i["ID"];
         $nombre = $i["Nombre"]; 
         $codigopostal = $i["Codigopostal"];
         $provincia = $i["Provincia"];
         $localidad= $i["Localidad"];
         $direccion = $i["Direccion"];
         $telefono = $i["Telefono"];
         $horario = $i["Horario"];

         $html .= <<<EOF
         <div class="tienda">
             <h3>$provincia</h3>
             <h5>$codigopostal</h5>
             <h4>$localidad</h4>
             <p>Dir: $direccion</p>
             <p>Tel: $telefono</p>
             <p>Horario: $horario</p>   
         </div>
        EOF;
     }
}
else{
     $html = <<<EOF
          <h4>Tiendas vacías</h4>
          EOF;
}

$form = new FormularioLocate();
$htmlFormBusc = $form->gestiona();

$contenidoPrincipal=<<<EOS
<h1>Tiendas de LibertyClothing</h1>    
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

EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';