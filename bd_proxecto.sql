CREATE DATABASE IF NOT EXISTS `pedidos`;
USE `pedidos`;

CREATE TABLE IF NOT EXISTS `categoria` (
  `CodCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Activo` BOOLEAN NOT NULL,
  `RutaIMX`varchar(200) NOT NULL,
  `RutaIcono`varchar(200) NOT NULL,
  PRIMARY KEY (`CodCategoria`),
  UNIQUE KEY `UN_NOM_CAT` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=LATIN1;

INSERT INTO `categoria` (`CodCategoria`, `Nombre`, `Descripcion`,`Activo`,`RutaIMX`, `RutaIcono`) VALUES
	(1, 'Carnes', 'Carnicería', 1, 'imaxes/carniceria.jpg', 'imaxes/iconos_taboa/carniceria.png'),
	(2, 'Peixes', 'Peixería', 1, 'imaxes/peixeria.jpg', 'imaxes/iconos_taboa/peixeria.png'),
	(3, 'Froitas e Verduras', 'Froitería / Verdulería', 1,'imaxes/verduras.jpg', 'imaxes/iconos_taboa/froitas.png'),
  (4, 'Conxelados', 'Produtos conxelados', 1,'imaxes/conxelados.jpg', 'imaxes/iconos_taboa/conxelados.png'),
  (5, 'Pastas e Arroces', 'Pastas e arroces en xeral', 1,'imaxes/pastas.jpg', 'imaxes/iconos_taboa/pasta.png'),
  (6, 'Panaderia','Pan e empanadas', 1,'imaxes/pans.jpg', 'imaxes/iconos_taboa/panaderia.png'),
  (7, 'Snacks e Doces', 'Doces en xeral', 1,'imaxes/snacks.jpg', 'imaxes/iconos_taboa/snack.png'),
  (8, 'Fogar', 'Produtos para o fogar', 1,'imaxes/fogar.jpg', 'imaxes/iconos_taboa/fogar.png'),
  (9, 'Hixiene','Produtos de hixiene', 1,'imaxes/hixiene.jpg', 'imaxes/iconos_taboa/hixiene.png'),
  (10,'Nadal', 'Produtos de nadal', 0,'imaxes/verduras.jpg', 'imaxes/iconos_taboa/nadal.png');
  
  
CREATE TABLE if NOT EXISTS `rol`(
`CodigoRol`INT(5) NOT NULL,
`TipoRol` VARCHAR(90) NOT NULL,
PRIMARY KEY	(`CodigoRol`)
)ENGINE=INNODB AUTO_INCREMENT=2 DEFAULT CHARSET=LATIN1;

INSERT INTO `rol`(`CodigoRol`, `TipoRol`) VALUES 
	(1, 'Administrador'),
	(2, 'Cliente');

CREATE TABLE IF NOT EXISTS `usuario` (
  `CodUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Correo` varchar(90) NOT NULL,
  `Contrasinal` varchar(45) NOT NULL,
  `Pais` varchar(45) NOT NULL,
  `CP` int(5) DEFAULT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Enderezo` varchar(200) NOT NULL,
  `CodigoRol` INT(5) NOT NULL,
  `Activo` BOOLEAN NOT NULL,
  PRIMARY KEY (`CodUsuario`),
  UNIQUE KEY `UN_USU_COR` (`Correo`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`CodigoRol`) REFERENCES `rol`(`CodigoRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=LATIN1;

INSERT INTO `usuario` (`CodUsuario`, `Correo`, `Contrasinal`, `Pais`, `CP`, `Ciudad`, `Enderezo`, `CodigoRol`,`Activo`) VALUES
	(1, 'anxo', '1234', 'España', 15840, 'Santa Comba', 'Rua Pontevedra', 1, 1),
	(2, 'manuel', '1234', 'España', 15840, 'Santa Cataliña', 'Avenida Alfonso Molina', 2, 1);
  


CREATE TABLE IF NOT EXISTS `pedido` (
  `CodPedido` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `EstadoPedido` VARCHAR(20) NOT NULL,
  `CodUsuario` int(11) NOT NULL,
  PRIMARY KEY (`CodPedido`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`CodUsuario`) REFERENCES `usuario` (`CodUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=LATIN1;

INSERT INTO `pedido` (`CodPedido`, `Fecha`, `EstadoPedido`, `CodUsuario`) VALUES
	(3, '2022-11-27 19:23:14', 'Enviado', 2),
	(4, '2022-11-27 19:24:17', 'Enviado', 2),
	(5, '2022-11-27 19:25:39', 'Enviado', 2);

CREATE TABLE IF NOT EXISTS `producto` (
  `CodProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(90) NOT NULL,
  `Peso` float NOT NULL,
  `Stock` int(11) NOT NULL,
  `CodCategoria` int(11) NOT NULL,
  `Activo` BOOLEAN NOT NULL, 
  `Prezo`float NOT NULL,
  `RutaProducto`varchar(200) NOT NULL,
  PRIMARY KEY (`CodProducto`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`CodCategoria`) REFERENCES `categoria`(`CodCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=LATIN1;

INSERT INTO `producto` (`CodProducto`, `Nombre`, `Descripcion`, `Peso`, `Stock`, `CodCategoria`, `Activo`, `Prezo`,`RutaProducto`) VALUES
	(1, 'Chuleta ternera gallega', 'Chuleta de ternera gallega', 1, 100, 1, 1, 14,'imaxes/carniceria.jpg'),
	(2, 'Ollomol', 'Ollomol de proximidade', 0.5, 20, 2, 1, 5,'imaxes/carniceria.jpg'),
	(3, 'Mandarina', 'Mandarina valenciana', 0.15, 50, 3, 1, 2.20,'imaxes/carniceria.jpg'),
  (4, 'Croquetas', 'Croquetas de xamon', 0.5, 30, 4, 1, 1.99,'imaxes/carniceria.jpg'),
  (5, 'Chuleta ternera asturiana', 'Chuleta de ternera asturiana', 1, 0, 1, 0, 11,'imaxes/carniceria.jpg'),
  (6, 'Arroz blanco', 'Arroz redondo blanco', 1, 50, 5, 1, 1.20,'imaxes/carniceria.jpg'),
  (7, 'Barra Baguette', 'Pan francés de sempre', 0.3, 50, 6, 1, 0.60,'imaxes/carniceria.jpg'),
  (8, 'Barra Chapata', 'Pan con xeito', 0.550, 40, 6, 1, 1.10,'imaxes/carniceria.jpg');

CREATE TABLE IF NOT EXISTS `pedidosproducto` (
  `CodPedProd` int(11) NOT NULL AUTO_INCREMENT,
  `CodPedido` int(11) NOT NULL,
  `CodProducto` int(11) NOT NULL,
  `Unidades` int(11) NOT NULL,
  `CodUsuario` INT(11) NOT NULL,
  PRIMARY KEY (`CodPedProd`),
  KEY `CodPedido` (`CodPedido`),
  KEY `CodProducto` (`CodProducto`),
  CONSTRAINT `pedidosproducto_ibfk_1` FOREIGN KEY (`CodUsuario`) REFERENCES `usuario`(`CodUsuario`),
  CONSTRAINT `pedidosproducto_ibfk_2` FOREIGN KEY (`CodProducto`) REFERENCES `producto` (`CodProducto`),
  CONSTRAINT `pedidosproducto_ibfk_3` FOREIGN KEY (`CodPedido`) REFERENCES `pedido`(`CodPedido`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=LATIN1;

INSERT INTO `pedidosproducto` (`CodPedProd`, `CodPedido`, `CodProducto`, `Unidades`, `CodUsuario`) VALUES
	(1, 3, 3, 5, 2),
	(2, 4, 3, 4, 2),
	(3, 5, 1, 5, 2);

/*CREATE TABLE IF NOT EXIST `log` (
  `CodLog` int(11) NOT NULL AUTO_INCREMENT,
  `CodUsuario` INT(11) NOT NULL,
  `CodPedido` int(11) NOT NULL,
  PRIMARY KEY (`CodLog`),
  KEY `CodUsuario` (`CodUsuario`),
  KEY `CodPedido` (`CodPedido`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`CodUsuario`) REFERENCES `usuario`(`CodUsuario`),
  CONSTRAINT `log_ibfk_3` FOREIGN KEY (`CodPedido`) REFERENCES `pedido`(`CodPedido`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=LATIN1;
*/

