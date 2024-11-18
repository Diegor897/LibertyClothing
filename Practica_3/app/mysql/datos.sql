/*
  Recuerda que deshabilitar la opción "Enable foreign key checks" para evitar problemas a la hora de importar el script.
*/
use libertyclothing;

TRUNCATE TABLE `roles`;
TRUNCATE TABLE `rolesusuario`;
TRUNCATE TABLE `usuarios`;
TRUNCATE TABLE `ropa`;
TRUNCATE TABLE `valoraciones`;
TRUNCATE TABLE `tiendas`;


INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'user');

INSERT INTO `rolesusuario` (`usuario`, `rol`) VALUES
(1, 1),
(1, 2),
(2, 2);

INSERT INTO `usuarios` (`ID`, `Correo`, `Contraseña`, `Nombreusuario`, `Código_Postal`, `Nombre`, `Dirección`, `FotoPerfil`) VALUES
(1,'admin@gmail.com', '$2y$10$O3c1kBFa2yDK5F47IUqusOJmIANjHP6EiPyke5dD18ldJEow.e0eS', 'admin', 28026, 'admin', 'calle1', '/imagenes/Maria.jpg'),
(2,'user@gmail.com', '$2y$10$uM6NtF.f6e.1Ffu2rMWYV.j.X8lhWq9l8PwJcs9/ioVKTGqink6DG', 'user', 28026, 'user', 'calle2', '/imagenes/Mauri.jpg');

INSERT INTO `tiendas`(`ID`, `Nombre`, `Codigopostal`, `Provincia`, `Localidad`, `Direccion`, `Telefono`, `Horario`) VALUES 
('0','Liberty Clothing',35010,'Las Palmas','Palmas','Urbanización Diaz Casanova',987654321,'9:00-22:00'),
('1','Liberty Clothing1',50001,'Zaragoza','Zaragoza','Paseo Independencia, 5',976910047,'9:00-22:00'),
('2','Liberty Clothing2',01015,'Álava','Vitoria','Calle Perretagana, 24',945270233,'9:00-22:00'),
('3','Liberty Clothing3',03001,'Alicante','Alicante','Avenida Alfonso El Sabio, 27',965212022,'9:00-22:00'),
('4','Liberty Clothing4',45612,'Toledo','Velada','Carretera Nacional 502',925892464,'9:00-22:00'),
('5','Liberty Clothing5',48150,'Vizcaya','Sondika','Avenida Txori Erri',944711061,'9:00-22:00'),
('6','Liberty Clothing6',11402,'Cádiz','Jerez de la Frontera','Calle Eguiluz, 6',963258741,'9:00-22:00'),
('7','Liberty Clothing7',29601,'Malaga','Marbella','Avenida Ricardo Soriano, 22',953518789,'9:00-22:00'),
('8','Liberty Clothing8',03803,'Alicante','Alcoy ','Calle Cid, 22',965520450,'9:00-22:00'),
('9','Liberty Clothing9',41410,'Sevilla','Carmona','Paseo Del Estatuto, 16',904155236,'9:00-22:00'),
('10','Liberty Clothing10',28003,'Madrid','Madrid','Avenida Filipinas, 1',945863274,'9:00-22:00'),
('11','Liberty Clothing11',08930,'Barcelona','Sant Adria Besos','Calle Mare De Deu De Covadonga, 23',904155278,'9:00-22:00');

INSERT INTO `ropa` (`ID`, `Nombre`, `Stock`, `Color`, `Categoria`, `Talla`, `Descripcion`, `Precio`, `Imagen`) VALUES
(1,"Camiseta cuadros", 15, "amarillo", "Camisas", 'S,M,L,XL', "Camisa a cuadros de estilo cowboy", 133, "imagenes/productos/camisacuadros.jpg"),
(2,"Sudadera básica", 13, "negro", "Sudaderas", 'M,L,XL', "Sudadera básica perfecta para invierno", 34, "imagenes/productos/sudadera1.jpg"),
(3,"Jersey básica", 14, "verde", "Jerseys", 'XS,S,M,L', "Jersey básico cómodo y elegante", 56, "imagenes/productos/sudadera2.jpg"),
(4,"Vestido de noche", 67, "negro", "Vestidos", 'XS,S,M,L,XL', "Vestido de noche elegante", 145, "imagenes/productos/vestido.jpg"),
(5,"Camiseta básica", 45, "negro", "Camisetas", 'XS,S,M,L,XL', "Camiseta básica para hombre", 30, "imagenes/productos/camiseta.jpg"),
(6,"Pantalón cargo", 23, "azul", "Pantalones", 'XS,S,M,L,XL', "Pantalón cargo deporte", 67, "imagenes/productos/pantalones.jpg"),
(7,"Pantalón chino", 23, "azul", "Pantalones", 'XS,S,M,L,XL', "Pantalón cargo deporte", 67, "imagenes/productos/pantalones.jpg"),
(8,"Pantalón vaquero", 23, "azul", "Pantalones", 'XS,S,M,L,XL', "Pantalón cargo deporte", 67, "imagenes/productos/pantalones.jpg"),
(9,"Pantalón trekking", 23, "azul", "Pantalones", 'XS,S,M,L,XL', "Pantalón cargo deporte", 67, "imagenes/productos/pantalones.jpg"),
(10,"Pantalón corto", 23, "azul", "Pantalones", 'XS,S,M,L,XL', "Pantalón cargo deporte", 67, "imagenes/productos/pantalones.jpg");


INSERT INTO `valoraciones`(`NombreUsuario`, `idProducto`, `Titulo`, `Descripción`, `Estrellas`, `Fecha`, `MeGustas`) VALUES 
('user','1','Me gusta','','4','21:30:00-17/03/2023',0),
('maria','1','Es fantástica','Calidad optima, precios muy asequibles, rapidez en la entrega y paquete muy bien presentado. Ademas detallistas ya que enviaron un detalle junto con mi pedido. Encantada!!!','5','21:30:00-17/03/2023',0),
('user','2','Tiene defecto','Tiene un agujero, quiero mi dinero','0','21:30:00-17/03/2023',0),
('user','3','xD','','3','21:30:00-17/03/2023',0),
('user','4','Combina con todo','','5','21:30:00-17/03/2023',0),
('user','5','Genial','','4','21:30:00-17/03/2023',0),
('user','6','Sin más','No tiene la calidad que se prometía, pero llegó en buenas condiciones','2','21:30:00-17/03/2023',0);
/*SET @INICIO := NOW();
INSERT INTO `Mensajes` (`id`, `autor`, `mensaje`, `fechaHora`, `idMensajePadre`) VALUES
(1, 1, 'Bienvenido al foro', @INICIO, NULL),
(2, 2, 'Muchas gracias', ADDTIME(@INICIO, '0:15:0'), 1),
(3, 2, 'Otro mensaje', ADDTIME(@INICIO, '25:15:0'), NULL);*/