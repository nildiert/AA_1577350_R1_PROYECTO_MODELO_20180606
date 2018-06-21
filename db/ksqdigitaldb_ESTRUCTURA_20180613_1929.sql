-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.30-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para ksqdigital
CREATE DATABASE IF NOT EXISTS `ksqdigital` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `ksqdigital`;

-- Volcando estructura para tabla ksqdigital.categorialibro
CREATE TABLE IF NOT EXISTS `categorialibro` (
  `catLibId` int(11) NOT NULL AUTO_INCREMENT,
  `catLibNombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `catLibObservacion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`catLibId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `Cliid` int(11) NOT NULL COMMENT 'Para dar una identificacion al cliente',
  `CliNombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Para registrar el nombre del cliente que esta realizando una orden de compra',
  `CliDireccion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Para registrar la direccion del cliente que esta realizando una orden de compra',
  `CliTelefono` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Para registrar el telefono del cliente que esta realizando una orden de compra',
  `CliUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Registra el usuario que genero la ultima operacion sobre la tuble',
  `Cli_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra el tiempo de creacion de la tupla\n',
  `Cli_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Registra el tiempo en el que se actualiza cualquier dato de la tupla',
  `CliEstado` tinyint(1) DEFAULT '1' COMMENT 'Este campo se utiliza para establecer si esta activo o inactivo el valor',
  PRIMARY KEY (`Cliid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla para almacenar los clientes que generan los pedidos\n';

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.insordcom
CREATE TABLE IF NOT EXISTS `insordcom` (
  `Insumos_InsCodigo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Ordencompra_OrdComId` int(11) NOT NULL,
  `InsordcomUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '\nRegistra el usuario que genero la ultima operacion sobre la tuble\n',
  `Insordcom_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra el tiempo de creacion de la tupla',
  `Insordcom_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Registra el tiempo en el que se actualiza cualquier dato de la tupla',
  `InsordcomEstado` tinyint(1) DEFAULT '1' COMMENT 'Este campo se utiliza para establecer si esta activo o inactivo el valor',
  PRIMARY KEY (`Insumos_InsCodigo`,`Ordencompra_OrdComId`),
  KEY `fk_insordcom_ordencompra1_idx` (`Ordencompra_OrdComId`),
  CONSTRAINT `fk_insordcom_insumos1` FOREIGN KEY (`Insumos_InsCodigo`) REFERENCES `insumos` (`InsCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_insordcom_ordencompra1` FOREIGN KEY (`Ordencompra_OrdComId`) REFERENCES `ordencompra` (`OrdComId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla en la que se relacionan los insumos y las ordenes de compra ';

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.insumos
CREATE TABLE IF NOT EXISTS `insumos` (
  `InsCodigo` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ID de cada insumo',
  `InsNombre` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Nombre de los insumos',
  `InsUnidadMedida` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Unidad de medida en la que se realizan los calculos de los insumos\\\\n',
  `InsPrecio` int(11) DEFAULT NULL COMMENT 'Precio unitario de cada insumo\\\\n',
  `InsCantActual` double DEFAULT NULL COMMENT 'Almacena la cantidad actual del insumo',
  `InsUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Registra el usuario que genero la ultima operacion sobre la tuble',
  `Ins_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra el tiempo de creacion de la tupla',
  `Ins_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Registra el tiempo en el que se actualiza cualquier dato de la tupla',
  `InsEstado` tinyint(1) DEFAULT '1' COMMENT 'Este campo se utiliza para establecer si esta activo o inactivo el valor',
  PRIMARY KEY (`InsCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla en la que se almacenan los datos y caracteristicas de los insumos';

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.libros
CREATE TABLE IF NOT EXISTS `libros` (
  `isbn` int(5) NOT NULL DEFAULT '0',
  `titulo` varchar(236) DEFAULT NULL,
  `autor` varchar(305) DEFAULT NULL,
  `precio` varchar(10) DEFAULT NULL,
  `categoriaLibro_catLibId` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`isbn`,`categoriaLibro_catLibId`),
  KEY `fk_libros_categoriaLibro1_idx` (`categoriaLibro_catLibId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.ordencompra
CREATE TABLE IF NOT EXISTS `ordencompra` (
  `OrdComId` int(11) NOT NULL,
  `OrdComFecha` date DEFAULT NULL,
  `OrdComUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '\nRegistra el usuario que genero la ultima operacion sobre la tuble\n',
  `OrdCom_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra el tiempo de creacion de la tupla',
  `OrdCom_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Registra el tiempo en el que se actualiza cualquier dato de la tupla',
  `OrdComEstado` tinyint(1) DEFAULT '1' COMMENT 'Este campo se utiliza para establecer si esta activo o inactivo el valor',
  PRIMARY KEY (`OrdComId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla en la que se guardan los consecutivos de las ordenes de compra';

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.ordenproduccion
CREATE TABLE IF NOT EXISTS `ordenproduccion` (
  `OrdPId` int(11) NOT NULL COMMENT 'Id de las ordenes de producción',
  `OrdPFecha` date DEFAULT NULL COMMENT 'Fecha en la que se registra la orden de producción',
  `OrdPAsignada` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Persona a la que se le asigna la orden de producción\\\\n',
  `OrdPFuente` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Persona que asigno la orden de producción\\\\n',
  `OrdPCant` int(11) DEFAULT NULL COMMENT 'Cantidad solicitada por cada producto',
  `OrdPObservaciones` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Observaciones registradas en cada orden de producción \\\\n',
  `Cliente_Cliid` int(11) NOT NULL COMMENT 'Relación existente entre el id de cliente y la orden de producción',
  `Productos_ProCodigo` int(11) NOT NULL COMMENT 'Establece la relación entre la orden de producción y el código del producto',
  `OrdenprodUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Registra el usuario que genero la ultima operacion sobre la tuble',
  `Ordenprod_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra el tiempo de creacion de la tupla',
  `Ordenprod_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Registra el tiempo en el que se actualiza cualquier dato de la tupla',
  `OrdenprodEstado` tinyint(1) DEFAULT '1' COMMENT 'Este campo se utiliza para establecer si esta activo o inactivo el valor',
  `OrdPFechaEntrega` date DEFAULT NULL COMMENT 'Esta tabla guarda la fecha de entrega de la orden de producción',
  PRIMARY KEY (`OrdPId`,`Cliente_Cliid`,`Productos_ProCodigo`),
  KEY `fk_ordenproduccion_Cliente1_idx` (`Cliente_Cliid`),
  KEY `fk_ordenproduccion_productos1_idx` (`Productos_ProCodigo`),
  CONSTRAINT `fk_ordenproduccion_Cliente1` FOREIGN KEY (`Cliente_Cliid`) REFERENCES `cliente` (`Cliid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ordenproduccion_productos1` FOREIGN KEY (`Productos_ProCodigo`) REFERENCES `productos` (`ProCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla en la que se almacena las ordenes de compra de un cliente';

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `perId` int(11) NOT NULL COMMENT 'Nos muetsra el Id de la tabla persona',
  `perDocumento` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nos muestra el documento de la persona',
  `perNombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nos muestra el nombre de la persona',
  `perApellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nos muestra el apellido de la persona',
  `perEstado` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Este campo se utiliza para establecer si esta activo o inactivo el valor',
  `perUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Guarda el usuario que se encuentra activo en la sesión',
  `per_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Guarda la fecha y hora en la que un usuario crea un valor en la base de datos\n',
  `per_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Guarda la fecha y la hora en la que se actualiza un valor en la base de datos',
  `usuario_s_usuId` int(11) NOT NULL,
  PRIMARY KEY (`perId`,`usuario_s_usuId`),
  UNIQUE KEY `uniq_documento` (`perDocumento`),
  KEY `fk_persona_usuario_s1_idx` (`usuario_s_usuId`),
  CONSTRAINT `fk_persona_usuario_s1` FOREIGN KEY (`usuario_s_usuId`) REFERENCES `usuario_s` (`usuId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Esta tabla nos muestra los datos de la persona ';

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `ProCodigo` int(11) NOT NULL COMMENT 'ID  de producto\\\\n',
  `ProNombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Nombre del producto',
  `ProPresentacion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Presentación en la que se vende cada producto una vez este fabricado',
  `ProDescripcion` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Descripción del producto',
  `ProPrecioBogota` int(11) DEFAULT NULL COMMENT 'Precio del producto en Bogotá',
  `ProPrecioNacional` int(11) DEFAULT NULL COMMENT 'Precio del producto a nivel nacional',
  `ProMaquila` int(11) DEFAULT NULL COMMENT 'Costo de producción del producto',
  `ProdUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Registra el usuario que genero la ultima operacion sobre la tuble',
  `Prod_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra el tiempo de creacion de la tupla',
  `Prod_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Registra el tiempo en el que se actualiza cualquier dato de la tupla',
  `ProdEstado` tinyint(1) DEFAULT '1' COMMENT 'Este campo se utiliza para establecer si esta activo o inactivo el valor',
  PRIMARY KEY (`ProCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla en la que se almacenan los datos y caracteristicas de los productos';

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.proins
CREATE TABLE IF NOT EXISTS `proins` (
  `Productos_ProCodigo` int(11) NOT NULL,
  `Insumos_InsCodigo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `ProinsObservacion` text COLLATE utf8_unicode_ci,
  `ProinsUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Registra el usuario que genero la ultima operacion sobre la tuble',
  `ProinsCantProd` double DEFAULT NULL COMMENT 'Se guarda la cantidad necesaria de un insumo para la elaboración de un producto',
  `Proins_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra el tiempo de creacion de la tupla',
  `Proins_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Registra el tiempo en el que se actualiza cualquier dato de la tupla',
  `ProinsEstado` tinyint(1) DEFAULT '1' COMMENT 'Este campo se utiliza para establecer si esta activo o inactivo el valor',
  KEY `fk_proins_insumos1_idx` (`Insumos_InsCodigo`),
  KEY `fk_proins_productos1` (`Productos_ProCodigo`),
  CONSTRAINT `fk_proins_insumos1` FOREIGN KEY (`Insumos_InsCodigo`) REFERENCES `insumos` (`InsCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proins_productos1` FOREIGN KEY (`Productos_ProCodigo`) REFERENCES `productos` (`ProCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla de relacion entre productos e insumos';

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.proveedor
CREATE TABLE IF NOT EXISTS `proveedor` (
  `ProvCodigo` int(11) NOT NULL COMMENT 'Id de proveedor\\\\n',
  `ProvNombre` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Nombre del proveedor\\\\n',
  `ProvUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Registra el usuario que genero la ultima operacion sobre la tuble',
  `Prov_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra el tiempo de creacion de la tupla\n',
  `Prov_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Registra el tiempo en el que se actualiza cualquier dato de la tupla',
  `ProvEstado` tinyint(1) DEFAULT '1' COMMENT 'Este campo se utiliza para establecer si esta activo o inactivo el valor',
  PRIMARY KEY (`ProvCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla en la que se guardan los datos principales de los proveedores de insumos';

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.provins
CREATE TABLE IF NOT EXISTS `provins` (
  `Insumos_InsCodigo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Proveedor_ProvCodigo` int(11) NOT NULL,
  `ProvinsPrecio` int(11) DEFAULT NULL COMMENT 'Precio insumo\n',
  `ProvinsFecha` date DEFAULT NULL COMMENT 'Fecha del precio del insumo para el proveedor',
  `ProvinsUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Registra el usuario que genero la ultima operacion sobre la tuble',
  `Provins_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra el tiempo de creacion de la tupla',
  `Provins_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Registra el tiempo en el que se actualiza cualquier dato de la tupla',
  `ProvinsEstado` tinyint(1) DEFAULT '1' COMMENT 'Este campo se utiliza para establecer si esta activo o inactivo el valor',
  PRIMARY KEY (`Insumos_InsCodigo`,`Proveedor_ProvCodigo`),
  KEY `fk_provins_proveedor1_idx` (`Proveedor_ProvCodigo`),
  CONSTRAINT `fk_provins_insumos1` FOREIGN KEY (`Insumos_InsCodigo`) REFERENCES `insumos` (`InsCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_provins_proveedor1` FOREIGN KEY (`Proveedor_ProvCodigo`) REFERENCES `proveedor` (`ProvCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla en la que se relacionan los insumos y proveedores ';

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `rolId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registro único de los roles',
  `rolNombre` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre de los roles',
  `rolDescripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Descripción del tipo de rol',
  `rolEstado` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado del rol(Activo, Inactivo)\n',
  `rolUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Guarda el usuario que se encontraba activo en la sesión',
  `rol_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Guarda la fecha y la hora de las en la que se hizo la ultima creación en la tabla',
  `rol_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Guarda la hora y la fecha en la que se hizo la ultima actualización en la tupla',
  PRIMARY KEY (`rolId`),
  UNIQUE KEY `uniq_nombrerol` (`rolNombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(100) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass_js` varchar(100) NOT NULL,
  `pass_php` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(10) NOT NULL,
  `perfil` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.usuario_s
CREATE TABLE IF NOT EXISTS `usuario_s` (
  `usuId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registro unico de usuarios',
  `usuLogin` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Guarda nombre del usuario con el que se va a iniciar',
  `usuPassword` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Guarda las contraseñas de los usuarios\n',
  `usuUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Guarda la información de los usuarios que manipulan la tabla',
  `usuEstado` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Almacena el estado del usuario que esta activo en la sesión',
  `usuRemember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Recuerda la contraseña',
  `usu_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Guarda la hora y fecha en la que el usuario crea un nuevo elemento en la base de datos',
  `usu_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Guarda la hora y fecha en la que el usuario actualiza un campo en la tabla',
  PRIMARY KEY (`usuId`),
  UNIQUE KEY `uniq_login` (`usuLogin`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ksqdigital.usuario_s_roles
CREATE TABLE IF NOT EXISTS `usuario_s_roles` (
  `id_usuario_s` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fechaUserRol` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `obsFechaUserRol` text COLLATE utf8_unicode_ci,
  `usuRolUsuSesion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Guarda la hora y fecha en la que un usuario crea un elemento en la base de datos ',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Guarda la hora y la fecha en la que un usuario actualiza un campo en la tabla',
  `usuario_s_rolesEstado` tinyint(4) DEFAULT NULL COMMENT 'Este campo se utiliza para establecer si esta activo o inactivo el valor',
  PRIMARY KEY (`id_usuario_s`,`id_rol`),
  KEY `usuario_s_roles_fk_rolidrol` (`id_rol`),
  CONSTRAINT `usuario_s_roles_fk_rolidrol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`rolId`),
  CONSTRAINT `usuario_s_roles_fk_usuario_sid` FOREIGN KEY (`id_usuario_s`) REFERENCES `usuario_s` (`usuId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
