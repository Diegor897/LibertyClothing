<!DOCTYPE html>
<html lang="es">
<head> 
    <title> Formulario de contacto </title>
    <meta charset="utf-8">
    <link id="estilo" rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="contenedor">
        <header>
            <h1>
                Liberty Clothing
                <img src="imagenes/logo.png" alt="Liberty Clothing logo" width="125">
            </h1>
            <div class="indice">
                <h3>
                    <a href="index.php">Indice</a>
                    <a href="detalles.php">Detalles</a>
                    <a href="bocetos.php">Bocetos</a>
                    <a href="miembros.php">Miembros</a>
                    <a href="planificacion.php">Planificación</a>
                    <a href="/LibertyClothing/Practica_3/app/index.php">Home</a>
                </h3>
            </div>
        </header>
        <main>

            <h2 style="text-align:center;"> Formulario de contacto </h2>

            <div class="formulario-contacto">
                <form action="mailto:liberty@gmail.com" method="post" enctype="text/plain">
                    <fieldset>
                        <div>
                            Nombre:<input type="text" placeholder="Nombre">
                        </div>
                        <div>
                            Email: <input type="text" placeholder="Email">
                        </div>
                        <div>
                            Motivo de la consulta: <input type="text" placeholder="Escriba aquí">
                        </div>
                        <div>
                            <input type="checkbox" name="terminoscondiciones" id="terminoscondiciones">
                            <label for="terminoscondiciones"> He leído los términos y condiciones del servicio. </label>
                        </div>
                        <button type="submit"> Enviar </button>
                    </fieldset>
                </form>
            </div>
            </main>    
    </div>
    <footer style="text-align:center;">
        <address>Madrid, Universidad Complutense de Madrid</address>
        <small>&copy;LibertyClothing</small>
    </footer>
</body>
</html>