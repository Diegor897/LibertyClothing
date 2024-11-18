<?php
function buildReviewForm($idProducto, $titulo ='',$desc ="", $estrellas= 0){
    $checked5 = "";
    $checked4 = "";
    $checked3 = "";
    $checked2 = "";
    $checked1 = "";
    switch ($estrellas){
        case 5:
            $checked5 .= "checked";
            break;
        case 4:
            $checked4 .= "checked";
            break;
        case 3:
            $checked3 .= "checked";
            break;
        case 2:
            $checked2 .= "checked";
            break;
        case 1:
            $checked1 .= "checked";
            break;
    }
return <<<EOS
    <form id="formLogin" action="procesarNuevaValoracion.php" method="POST">
        <input type="hidden" name="idProducto" value="$idProducto" />
        <div class= "formularioValoracion-seccion">Puntuación</div>
        <p class= "formularioValoracion-clasificacion">
            <input id="radio1" type="radio" name="estrellas" value="5" $checked5><label for="radio1">★</label>
            <input id="radio2" type="radio" name="estrellas" value="4" $checked4><label for="radio2">★</label>
            <input id="radio3" type="radio" name="estrellas" value="3" $checked3><label for="radio3">★</label>
            <input id="radio4" type="radio" name="estrellas" value="2" $checked2><label for="radio4">★</label>
            <input id="radio5" type="radio" name="estrellas" value="1" $checked1><label for="radio5">★</label>
        </p>
        <div class= "formularioValoracion-seccion">Añada un título</div>
        <p>
            <input class="formularioValoracion-titulo" type="text" name="titulo" value="$titulo" placeholder="Título de valoración" required>
        </p>
        <div class= "formularioValoracion-seccion">Añada una descripción</div>
        <p>
            <textarea class="formularioValoracion-desc" name= "desc" placeholder="Descripción">$desc</textarea>
        </p>
        <div><button type="submit">Enviar</button></div>
    </form>
EOS;
}
?>