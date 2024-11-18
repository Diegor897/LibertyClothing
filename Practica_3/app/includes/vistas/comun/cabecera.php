<header>
            
    <img class="img-logo" src= "<?php echo RUTA_IMGS ?>/logo.png" alt="Liberty Clothing logo">
    <h1>LIBERTY CLOTHING</h1>

    <?php

        use es\ucm\fdi\aw\FormularioLogout as FormularioLogout;
        use es\ucm\fdi\aw\FormularioEditarPerfil as FormularioEditarPerfil;

        if(isset($_SESSION["login"]) && $_SESSION["login"]) {
            
            $formLogout = new FormularioLogout();
            $htmlForm = $formLogout->gestiona();

            echo "<p> Bienvenido {$_SESSION['nombre']} $htmlForm";

            echo("
                <form action='perfil.php'>
                    <button type='submit'>Editar perfil</button>
                </form>
            ");

            if (isset($_SESSION['esAdmin']) && $_SESSION['esAdmin']) {
                echo("
                    <form action='administracion.php'>
                        <button type='submit'>Administración</button>
                    </form>
                ");
            }
        }
        else{
            echo "<p> Usuario Desconocido.  <a href= ".RUTA_APP."/login.php>  Login </a> </p>";
            echo "<p> <a href=".RUTA_APP."/registro.php>  Registrate </a> </p>";
        }
    ?>

</header>
<?php
    echo "<div class='barranav'>";
    echo    "<ul>";
    echo        "<li><a href= ".RUTA_APP."/index.php>Home</a></li>";
    echo        "<li><a href= ".RUTA_APP."/catalogo.php>Catalogo</a></li>";
    echo        "<li><a href= ".RUTA_APP."/carrito.php>Carrito</a></li>";
    echo        "<li><a href= ".RUTA_APP."/tiendas.php>Localizador de tiendas</a></li>";
    echo    "</ul>";
    echo "</div>";
?>