<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Bocetos Liberty Clothing</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">

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
                        <a href="miembros.php">Miembros</a>
                        <a href="planificacion.php">Planificación</a>
                        <a href="contacto.php">Contacto</a>
                        <a href="/LibertyClothing/Practica_3/app/index.php">Home</a>
                    </h3>
                </div>
            </header>
            <main>
                <h1>Bocetos</h1>
                <p>A continuación vamos a explicar las diferentes páginas del proyecto y las funcionalidades a las que pertenecen</p>
                <article>
                    <h2>Índice:</h2>
                    <p>
                        El índice es la página principal de nuestra página web, cuenta con una cabcera en la que tendremos el nombre de nuestra empresa,
                        unas noticias sobre las últimas adiciones de ropa a la página y un desplegable arriba a la izquierda por el que podremos acceder
                        a las distintas funcionalidades de la página web, por útlimo arriba a la derecha tendremos el menu de usuario a través del cual 
                        los ususarios se drán de alta en la página y podrán visualizar su perfil. En el pie de la página se encontrará nuestra información
                        de contacto.
                    </p>
                    <img alt="Imagen de la página principal de LibertyClothing" src="imagenes/bocetos/indice.png" width="750">
                </article>
             
             
                <article>
                    <h2>Gestión de compras:</h2>
                    <p>
                        La funcionalidad gestión de compras cuenta con cuatro páginas diferentes para la validación de la compra:
                    </p>
                    <ol>
                        <li>
                            <h3>Resumen de compra:</h3>
                                En esta página al usuario se le muestran los elementos que haya decidido comprar, junto con el precio total que suman. 
                                El usuario puede añadir o eliminar elementos al carrito antes de darle a la siguiente fase.
                             
                            <img alt="Imagen de visualización de producto" src="imagenes/bocetos/Carrito_1.png" width="750">
                        </li>
                        <li>
                            <h3>Lugar de envio:</h3>
                                Después de la página de resumen de compra el usuario debe especificar la dirección donde quiere recibr su pedido, 
                                el usuario debe introducir una dirección a mano.
                             
                            <img alt="Imagen de selección de dirección" src="imagenes/bocetos/Carrito_2.png" width="750">
                        </li>
                        <li>
                            <h3>Método de pago:</h3>
                                Después de especficar el lugar de envío el usuario deberá escoger como quiere realizar el pago de los productos, 
                                este tendrá dos opciones, el pago en metálico del producto cuando sea entregado o pagar con tarjeta en el navegador, 
                                para lo cual deberá introducir los datos de su tarjeta.
                             
                            <img alt="Imagen de selección de metodo de pago" src="imagenes/bocetos/Carrito_3.png" width="750">
                        </li>
                        <li>
                            <h3>Finalización pago:</h3>
                                Después de rellenar todos los requisitos anteriores habremos terminado la compra y la web nos informará de ello con 
                                información en pantalla y ofrecerá dos opciones, continuar con las compras y volver al indice o salir que les llevará a 
                                la pantalla de logout. 
                             
                            <img alt="Imagen de confirmación de compra" src="imagenes/bocetos/Carrito_final.png" width="750">
                        </li>
                    </ol>
                </article>
                <article>
                    <h2>Herramientas del administrador</h2>
                    <p>
                        Las herramientas del administrador permiten modificar la base de datos para mantener el catálogo de ropa y las sucursales actualizadas. 
                        Solo el administrador tiene acceso a esta página.
                    </p>
                        <img alt="Imagen menu herramientas administrador" src="imagenes/bocetos/Herramientas_administrador.png" width="750">
                         
                        <ol>
                            <li><h3>Añadir ropa:</h3>
                                Esta página presenta al administrador un formulario para añadir una nueva prenda de ropa al catálogo, después de rellenar los datos 
                                se actualiza la base de datos y se le presenta un mensaje de confirmación al administrador antes de devolverle de forma automática a 
                                la página de herramientas.
                                 
                                <img alt="Imagen herramienta añadir ropa" src="imagenes/bocetos/Añadir_ropa.png" width="750">
                            </li>
                            <li><h3>Eliminar ropa:</h3>
                                Así como a la hora de añadir una prenda de ropa, esta página presenta al administrador un formulario a través del cual seleccionará una 
                                prenda de ropa para que sea eliminada de la base de datos, una vez terminado el proceso se le muestra al administrador un mensaje de confirmación 
                                y se le devuelve a la página de herramientas.
                                 
                                <img alt="Imagen herramienta eliminar ropa" src="imagenes/bocetos/Eliminar_ropa.png" width="750">
                            </li>
                            <li><h3>Añadir tienda:</h3>
                                Para mantener el localizador actualizado con las últimas tiendas que abramos, el administrador tendrá la opción de añadir dicha tienda a la base 
                                de datos, junto con la información que queremos proveer a los usuarios de la web. Una vez finalizado el proceso se les presentará un mensaje de confirmación 
                                y se les llevará al menu de herramientas.
                                 
                                <img alt="Imagen herramienta añadir tienda" src="imagenes/bocetos/Añadir_tienda.png" width="750">
                            </li>
                            <li><h3>Eliminar tienda:</h3>
                                El administrador puede eliminar tiendas mediante un formulario, una vez seleccionadas y confirmada la elección la base de datos se modificará 
                                y aparecerá un mensaje de confirmación que los devolverá al menú de herramientas.
                                 
                                <img alt="Imagen herramienta eliminar tienda" src="imagenes/bocetos/Eliminar_tienda.png" width="750"> 
                            </li>
                        </ol>
                </article>
                <article>
                    <h2>Vista de perfil</h2>
                    <p>
                        Todos los usuarios registrados tienen acceso a una vista de su perfil, en la que pueden ver sus datos y los puntos que llevan acumulados hasta el momento, adicionalmente 
                        pueden personalizar su perfil.
                    </p>
                     
                    <img alt="Imagen vista de perfil" src="imagenes/bocetos/Vista_Perfil.png" width="750">
                </article>
             
                <article>
                    <h2>Catálogo de ropa</h2>
                    <p>
                        El catalogo de ropa es accesible para todos los usuarios de la web, muestra diferentes tipos de ropa además de tener la posibilidad de hacer búsquedas y aplicar filtros. 
                    </p>
                     
                    <img alt="Imagen catalogo de ropa" src="imagenes/bocetos/Catálogo_1.png" width="750">
                        <ol>
                            <li><h3>Vista de filtros:</h3>
                                En la imagen podemos ver que se ha abierto el menú de filtros y nos esta mostrando todos los filtros disponibles, los filtros ayudan a nuestros usuarios a buscar de forma 
                                más eficiente en nuestro catálogo el tipo de ropa que deseen comprar.
                                 
                                <img alt="Imagen vista de filtros" src="imagenes/bocetos/Catálogo_2.png" width="750">
                            </li>
                            
                            <li><h3>Vista de productos:</h3>
                                Una vez el usuario seleccione el producto que desea comprar, una vista detallada del producto aparecerá ante el, en ella podrá observar la foto de stock del producto, 
                                un selector de talla, el precio del producto junto con una breve descripción subre el producto y debajo los comentarios de los diferentes usuarios sobre el producto en concreto.
                                 
                                <img alt="Imagen vista de productos" src="imagenes/bocetos/Producto.png" width="750">
                            </li>
                        </ol>
                </article>
             
                <article>
                    <h2>Buscador de tiendas</h2>
                    <p>
                        Esta funcionalidad es accesible para todos los usuarios, muestra la tienda más cercana basada en la información que provee el usuario (localidad, calle, código postal), aportando la dirección 
                        de la tienda y su horario de apertura.
                    </p>
                        <ol>
                            <li><h3>Vista general:</h3>
                                Vista del usuario antes de rellenar los campos del formulario.
                                 
                                <img alt="Imagen vista general tiendas" src="imagenes/bocetos/Tiendas_Cercanas_1.png" width="750">
                            </li>
                            <li><h3>Formulario rellenado:</h3>
                                Vista del formulario rellenado por el usuario con la respuesta del servidor.
                                 
                                <img alt="Imagen vista general formulario rellenado" src="imagenes/bocetos/Tiendas_Cercanas_2.png" width="750">
                            </li>
                        </ol>
                </article>
            </main>
        </div>
        <footer>
            <address>Madrid, Universidad Complutense de Madrid</address>
            <small>&copy;LibertyClothing</small>
        </footer>
    </body>
</html>