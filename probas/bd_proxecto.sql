CREATE DATABASE IF NOT EXISTS `pedidos`;
USE `pedidos`;


CREATE TABLE IF NOT EXISTS `categoria` (
  `CodCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Activo` BOOLEAN NOT NULL,
  PRIMARY KEY (`CodCategoria`),
  UNIQUE KEY `UN_NOM_CAT` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=LATIN1;

INSERT INTO `categoria` (`CodCategoria`, `Nombre`, `Descripcion`,`Activo`) VALUES
	(1, 'Comida', 'Platos e ingredientes', 1),
	(2, 'Bedidas sin', 'Bebidas sin alcohol', 1),
	(3, 'Bebidas con', 'Bebidas con alcohol', 1);


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
  PRIMARY KEY (`CodUsuario`),
  UNIQUE KEY `UN_USU_COR` (`Correo`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`CodigoRol`) REFERENCES `rol`(`CodigoRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=LATIN1;

INSERT INTO `usuario` (`CodUsuario`, `Correo`, `Contrasinal`, `Pais`, `CP`, `Ciudad`, `Enderezo`, `CodigoRol`) VALUES
	(1, 'david', '1234', 'España', 28002, 'Madrid', 'C/ Padre  Claret, 8', 1),
	(2, 'antonio', '1234', 'España', 11001, 'Cádiz', 'C/ Portales, 2 ', 2);


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
  PRIMARY KEY (`CodProducto`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`CodCategoria`) REFERENCES `categoria`(`CodCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=LATIN1;

INSERT INTO `producto` (`CodProducto`, `Nombre`, `Descripcion`, `Peso`, `Stock`, `CodCategoria`, `Activo`) VALUES
	(1, 'Harina', '8 paquetes de 1kg de harina cada uno', 8, 100, 1, 1),
	(2, 'Azúcar', '20 paquetes de 1kg cada uno', 20, 3, 1, 1),
	(3, 'Agua 0.5', '100 botellas de 0.5 litros cada una', 51, 100, 2, 1);

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

