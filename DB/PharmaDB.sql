-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2021 a las 01:43:16
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pharma`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `bitacoracod` int(11) NOT NULL,
  `bitacorafch` datetime DEFAULT NULL,
  `bitprograma` varchar(255) DEFAULT NULL,
  `bitdescripcion` varchar(255) DEFAULT NULL,
  `bitImpuesto` float DEFAULT NULL,
  `bitSubtotal` float DEFAULT NULL,
  `bitTotal` float DEFAULT NULL,
  `bitTipo` char(3) DEFAULT NULL,
  `bitusuario` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`bitacoracod`, `bitacorafch`, `bitprograma`, `bitdescripcion`, `bitImpuesto`, `bitSubtotal`, `bitTotal`, `bitTipo`, `bitusuario`) VALUES
(10, '2021-12-08 17:05:04', 'Programa', 'Orden Aceptada', 20.85, 139.98, 159.85, 'ACP', 9),
(11, '2021-12-08 17:12:09', 'Programa', 'Orden Aceptada', 5.85, 39.99, 44.85, 'ACP', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `carritoId` int(11) NOT NULL,
  `usuarioId` varchar(13) NOT NULL,
  `carritoCreadoEl` datetime NOT NULL,
  `carritoActualizadoEl` datetime NOT NULL,
  `carritoEstado` varchar(255) NOT NULL,
  `usuario_usercod` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`carritoId`, `usuarioId`, `carritoCreadoEl`, `carritoActualizadoEl`, `carritoEstado`, `usuario_usercod`) VALUES
(47, '', '2021-12-08 17:02:39', '2021-12-08 17:02:39', 'Actual', 9),
(48, '', '2021-12-08 17:11:43', '2021-12-08 17:11:43', 'Actual', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritoproducto`
--

CREATE TABLE `carritoproducto` (
  `carritoProductoId` int(11) NOT NULL,
  `productoId` int(11) NOT NULL,
  `carritoId` int(11) NOT NULL,
  `carritoProductoFechaAñadido` datetime NOT NULL,
  `carritoProductoFechaActualizado` datetime NOT NULL,
  `carritoProductoCantidad` int(11) NOT NULL,
  `carritoProductoTotal` float NOT NULL,
  `carritoProductoActivo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carritoproducto`
--

INSERT INTO `carritoproducto` (`carritoProductoId`, `productoId`, `carritoId`, `carritoProductoFechaAñadido`, `carritoProductoFechaActualizado`, `carritoProductoCantidad`, `carritoProductoTotal`, `carritoProductoActivo`) VALUES
(86, 1, 48, '2021-12-08 17:14:20', '2021-12-08 17:14:20', 1, 59.99, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

CREATE TABLE `funciones` (
  `fncod` varchar(255) NOT NULL,
  `fndsc` varchar(45) DEFAULT NULL,
  `fnest` char(3) DEFAULT NULL,
  `fntyp` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`fncod`, `fndsc`, `fnest`, `fntyp`) VALUES
('Controllers\\Admin\\Admin', 'Controllers\\Admin\\Admin', 'ACT', 'CTR'),
('Controllers\\Mnt\\Funciones', 'Controllers\\Mnt\\Funciones', 'ACT', 'CTR'),
('Controllers\\Mnt\\Laboratorio', 'Controllers\\Mnt\\Laboratorio', 'ACT', 'CTR'),
('Controllers\\Mnt\\Laboratorios', 'Controllers\\Mnt\\Laboratorios', 'ACT', 'CTR'),
('Controllers\\Mnt\\presentacion', 'Controllers\\Mnt\\presentacion', 'ACT', 'CTR'),
('Controllers\\Mnt\\Presentaciones', 'Controllers\\Mnt\\Presentaciones', 'ACT', 'CTR'),
('Controllers\\Mnt\\Rol', 'Controllers\\Mnt\\Rol', 'ACT', 'CTR'),
('Controllers\\Mnt\\Roles', 'Controllers\\Mnt\\Roles', 'ACT', 'CTR'),
('Controllers\\Mnt\\Usuario', 'Controllers\\Mnt\\Usuario', 'ACT', 'CTR'),
('Controllers\\Mnt\\Usuarios', 'Controllers\\Mnt\\Usuarios', 'ACT', 'CTR'),
('Controllers\\Pharmamnt\\Bitacora', 'Controllers\\Pharmamnt\\Bitacora', 'ACT', 'CTR'),
('Controllers\\Pharmamnt\\Bitacoras', 'Controllers\\Pharmamnt\\Bitacoras', 'ACT', 'CTR'),
('Controllers\\Pharmamnt\\Inventario', 'Controllers\\Pharmamnt\\Inventario', 'ACT', 'CTR'),
('Controllers\\Pharmamnt\\Inventarios', 'Controllers\\Pharmamnt\\Inventarios', 'ACT', 'CTR'),
('Controllers\\Pharmamnt\\Producto', 'Controllers\\Pharmamnt\\Producto', 'ACT', 'CTR'),
('Controllers\\Pharmamnt\\Productos', 'Controllers\\Pharmamnt\\Productos', 'ACT', 'CTR'),
('mnt_funciones_delete', 'mnt_funciones_delete', 'ACT', 'CTR'),
('mnt_funciones_edit', 'mnt_funciones_edit', 'ACT', 'CTR'),
('mnt_funciones_new', 'mnt_funciones_new', 'ACT', 'CTR'),
('WW_Bitacora', 'WW_Bitacora', 'ACT', 'CTR'),
('WW_Funciones', 'WW_Funciones', 'ACT', 'CTR'),
('WW_Inventario', 'WW_Inventario', 'ACT', 'CTR'),
('WW_Laboratorios', 'WW_Laboratorios', 'ACT', 'CTR'),
('WW_Presentaciones', 'WW_Presentaciones', 'ACT', 'CTR'),
('WW_Productos', 'WW_Productos', 'ACT', 'CTR'),
('WW_Roles', 'WW_Roles', 'ACT', 'CTR'),
('WW_Shop', 'WW_Shop', 'ACT', 'CTR'),
('WW_Usuarios', 'WW_Usuarios', 'ACT', 'CTR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones_roles`
--

CREATE TABLE `funciones_roles` (
  `rolescod` varchar(15) NOT NULL,
  `fncod` varchar(255) NOT NULL,
  `fnrolest` char(3) DEFAULT NULL,
  `fnexp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `funciones_roles`
--

INSERT INTO `funciones_roles` (`rolescod`, `fncod`, `fnrolest`, `fnexp`) VALUES
('Admin', 'Controllers\\Admin\\Admin', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Mnt\\Funciones', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Mnt\\Laboratorio', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Mnt\\Laboratorios', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Mnt\\presentacion', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Mnt\\Presentaciones', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Mnt\\Rol', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Mnt\\Roles', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Mnt\\Usuario', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Mnt\\Usuarios', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Pharmamnt\\Bitacora', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Pharmamnt\\Bitacoras', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Pharmamnt\\Inventario', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Pharmamnt\\Inventarios', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Pharmamnt\\Producto', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'Controllers\\Pharmamnt\\Productos', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'WW_Bitacora', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'WW_Funciones', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'WW_Inventario', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'WW_Laboratorios', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'WW_Presentaciones', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'WW_Productos', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'WW_Roles', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'WW_Shop', 'ACT', '2031-12-03 20:00:00'),
('Admin', 'WW_Usuarios', 'ACT', '2031-12-03 20:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `inventarioId` int(11) NOT NULL,
  `inventarioExistencias` float NOT NULL,
  `inventarioFechaCaducidad` date NOT NULL,
  `productoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`inventarioId`, `inventarioExistencias`, `inventarioFechaCaducidad`, `productoId`) VALUES
(1, 20, '2021-12-30', 1),
(2, 61, '2021-12-30', 2),
(3, 23, '2021-12-30', 3),
(4, 4, '2021-12-30', 4),
(5, 12, '2021-12-30', 5),
(6, 65, '2021-12-30', 6),
(7, 23, '2021-12-30', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `laboratorioId` int(11) NOT NULL,
  `laboratorioNombre` varchar(255) NOT NULL,
  `laboratorioDescripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`laboratorioId`, `laboratorioNombre`, `laboratorioDescripcion`) VALUES
(1, 'Lab L&L', 'Distribuidora de farmacos'),
(2, 'BAYER', 'Empresa químico-farmacéutica alemana fundada en Barmen, Alemania en 1863.​ Hoy en día, tiene su sede en Leverkusen, Renania del Norte-Westfalia, Alemania.​ Es bien conocida por su marca original de la aspirina'),
(3, 'Pfizer', 'Empresa farmacéutica estadounidense que, después de diversas fusiones llevadas a cabo con Pharmacia and Upjohn y Parke Davis, es el laboratorio líder a nivel mundial en el sector farmacéutico. La sociedad tiene su sede central en Nueva York.'),
(4, 'GSK', 'Empresa británica de productos farmacéuticos, productos de cuidado dental y de cuidado de la salud. GSK es el resultado de la fusión de Glaxo Wellcome y SmithKline Beecham.'),
(5, 'Roche', 'Empresa que se dedica a la industria farmacéutica, tiene sus sedes principales en las ciudad de Basilea y París, Francia. La sociedad es conocida bajo la marca “Roche” en todos sus segmentos y líneas de salud: medicamentos, y otros productos como vitamina'),
(7, 'Lab L&L', 'Distribuidora de farmacos'),
(8, 'Lab L&L', 'Distribuidora de farmacos'),
(9, 'Lab L&L', 'Distribuidora de farmacos'),
(10, 'Lab L&L', 'Distribuidora de farmacos'),
(11, 'Lab L&L', 'Distribuidora de farmacos 11'),
(12, 'P&G', 'empresa estadounidense multinacional de bienes de consumo con sede en Cincinnati, Estados Unidos. Fue fundada por William Procter y James Gamble en 1837 ambos originarios del Reino Unido.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `ordenId` int(11) NOT NULL,
  `usuarioId` varchar(13) NOT NULL,
  `ordenEstado` int(11) NOT NULL,
  `ordenSubtotal` float NOT NULL,
  `ordenDescuento` float NOT NULL,
  `ordenImpuestos` float NOT NULL,
  `ordenTotal` float NOT NULL,
  `ordenCreadoEl` datetime NOT NULL,
  `ordenActualizadoEl` datetime NOT NULL,
  `usuario_usercod` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenproducto`
--

CREATE TABLE `ordenproducto` (
  `ordenProductoId` int(11) NOT NULL,
  `productoId` int(11) NOT NULL,
  `ordenId` int(11) NOT NULL,
  `ordenProductoCantidad` int(11) NOT NULL,
  `ordenProductoImpuesto` float NOT NULL,
  `ordenProductoTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `presentacionId` int(11) NOT NULL,
  `presentacionNombre` varchar(255) NOT NULL,
  `presentacionDescripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`presentacionId`, `presentacionNombre`, `presentacionDescripcion`) VALUES
(1, 'Tabletas', 'Caja blanca, pequeña de 12 unidades.'),
(2, 'Jarabe', 'Para principios activos solubles en agua, con alto contenido en azÃºcar'),
(3, 'Gotas', ' presentaciones lÃ­quidas en las cuales el principio activo estÃ¡ mÃ¡s concentrado.'),
(4, 'Capsulas 100mg', 'Medicamentos solidos formados por compresión de sus constituyentes. 100Mg'),
(5, 'Inyeccion', 'Liquido ingresado en jeringa para introduccion directa en el clienta'),
(6, 'Capsulas 500mg', 'Medicamentos sÃ³lidos formados por compresiÃ³n de sus constituyentes. 500mg'),
(7, 'Polvo', 'El principio activo estÃ¡ en el polvo que debe prepararse antes de cada toma'),
(8, 'Unguento', 'Sustancia que se usa sobre la piel para calmar o curar las heridas, quemaduras, erupciones cutáneas o sarpullidos, raspados u otros problemas de la piel. También se llama pomada.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `productoId` int(11) NOT NULL,
  `productoNombre` varchar(255) NOT NULL,
  `productoDescripcion` varchar(255) NOT NULL,
  `productoCodigo` varchar(255) NOT NULL,
  `productoPrecio` float NOT NULL,
  `productoFechaCreado` datetime DEFAULT NULL,
  `productoFechaPublicado` datetime DEFAULT NULL,
  `productoFechaEditado` datetime DEFAULT NULL,
  `productoActivo` tinyint(1) NOT NULL,
  `presentacionId` int(11) NOT NULL,
  `laboratorioId` int(11) DEFAULT NULL,
  `productoImagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`productoId`, `productoNombre`, `productoDescripcion`, `productoCodigo`, `productoPrecio`, `productoFechaCreado`, `productoFechaPublicado`, `productoFechaEditado`, `productoActivo`, `presentacionId`, `laboratorioId`, `productoImagen`) VALUES
(1, 'Ibuprofeno', 'Ibuprofeno', 'SFG8374HJSAF', 59.99, '2021-11-03 20:00:00', '2021-11-03 20:00:00', '2021-11-03 20:00:00', 1, 1, 2, 'ibuprofeno.jpg'),
(2, 'Vick VapoRub', 'VapoRub', 'S76AF5ASD5SE', 29.99, '2021-11-03 20:00:00', '2021-11-03 20:00:00', '2021-11-03 20:00:00', 1, 8, 12, 'vick.jpg'),
(3, 'Bisolvon', 'Bisolvon', 'S9FD65AS76FS', 39.99, '2021-11-03 20:00:00', '2021-11-03 20:00:00', '2021-11-03 20:00:00', 1, 4, 4, 'bisolvon.jpg'),
(4, 'Simply Sleep', 'Simply Sleep', 'UY12IHG41ISAD', 69.99, '2021-11-03 20:00:00', '2021-11-03 20:00:00', '2021-11-03 20:00:00', 1, 4, 3, 'simply-sleep.png'),
(5, 'PeptoBismol', 'PeptoBismol', 'AS346G987BVU', 44.99, '2021-11-03 20:00:00', '2021-11-03 20:00:00', '2021-11-03 20:00:00', 1, 2, 5, 'pepto-bismol.jpeg'),
(6, 'Gotas para los ojos', 'Gotas para los ojos', 'SADF76S5FSAD', 24.99, '2021-11-03 20:00:00', '2021-11-03 20:00:00', '2021-11-03 20:00:00', 1, 3, 4, 'gotas-ojos.jpg'),
(7, 'Vitamina E', 'Vitamina E', 'Z97X68VHG98Z', 14.99, '2021-11-03 20:00:00', '2021-11-03 20:00:00', '2021-11-03 20:00:00', 1, 6, 2, 'vitamina-e.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rolescod` varchar(15) NOT NULL,
  `rolesdsc` varchar(45) DEFAULT NULL,
  `rolesest` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rolescod`, `rolesdsc`, `rolesest`) VALUES
('Admin', 'Administrador', 'ACT'),
('Usuario', 'Usuario', 'ACT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_usuarios`
--

CREATE TABLE `roles_usuarios` (
  `usercod` bigint(20) NOT NULL,
  `rolescod` varchar(15) NOT NULL,
  `roleuserest` char(3) DEFAULT NULL,
  `roleuserfch` datetime DEFAULT NULL,
  `roleuserexp` datetime DEFAULT NULL,
  `roles_usuarios_usercod` bigint(20) NOT NULL,
  `roles_usuarios_rolescod` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles_usuarios`
--

INSERT INTO `roles_usuarios` (`usercod`, `rolescod`, `roleuserest`, `roleuserfch`, `roleuserexp`, `roles_usuarios_usercod`, `roles_usuarios_rolescod`) VALUES
(9, 'Admin', 'ACT', '2021-12-08 16:33:33', '2031-12-03 20:00:00', 9, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usercod` bigint(20) NOT NULL,
  `useremail` varchar(80) DEFAULT NULL,
  `username` varchar(80) DEFAULT NULL,
  `userpswd` varchar(128) DEFAULT NULL,
  `userfching` datetime DEFAULT NULL,
  `userpswdest` char(3) DEFAULT NULL,
  `userpswdexp` datetime DEFAULT NULL,
  `userest` char(3) DEFAULT NULL,
  `useractcod` varchar(128) DEFAULT NULL,
  `userpswdchg` varchar(128) DEFAULT NULL,
  `usertipo` char(3) DEFAULT NULL COMMENT 'Tipo de Usuario, Normal, Consultor o Cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usercod`, `useremail`, `username`, `userpswd`, `userfching`, `userpswdest`, `userpswdexp`, `userest`, `useractcod`, `userpswdchg`, `usertipo`) VALUES
(9, 'admin@admin.com', 'Admin Test', '$2y$10$bet.b7U2D3HTVLx..OG9nejmAQ6T5jL7JQWqsS/mRs/jDci0OTHA2', '2021-12-08 16:33:33', 'ACT', '2022-03-08 00:00:00', 'ACT', 'c60268053b59139c3ef784860bff928e79bc6d609d992a095cd52ab6a055f2f2', '2021-12-08 16:33:33', 'PBL'),
(10, 'usuario@usuario.com', 'Usuario Test', '$2y$10$RMAR/XckbkVMIhcTgtfcv.JXPGieFZM5LHN2suR9gIfhRRf4akVAq', '2021-12-08 17:11:20', 'ACT', '2022-03-08 00:00:00', 'ACT', 'a7af58dc3a56dde81d091f26da789d4b182cbe65610c395addbdb321fa4ae7a6', '2021-12-08 17:11:20', 'PBL');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`bitacoracod`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`carritoId`),
  ADD KEY `fk_carrito_usuario1_idx` (`usuario_usercod`);

--
-- Indices de la tabla `carritoproducto`
--
ALTER TABLE `carritoproducto`
  ADD PRIMARY KEY (`carritoProductoId`),
  ADD KEY `CarritoProducto_fk0` (`productoId`),
  ADD KEY `CarritoProducto_fk1` (`carritoId`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`fncod`);

--
-- Indices de la tabla `funciones_roles`
--
ALTER TABLE `funciones_roles`
  ADD PRIMARY KEY (`rolescod`,`fncod`),
  ADD KEY `rol_funcion_key_idx` (`fncod`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`inventarioId`),
  ADD KEY `inventario_FK` (`productoId`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`laboratorioId`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`ordenId`),
  ADD KEY `fk_orden_usuario1_idx` (`usuario_usercod`);

--
-- Indices de la tabla `ordenproducto`
--
ALTER TABLE `ordenproducto`
  ADD PRIMARY KEY (`ordenProductoId`),
  ADD KEY `OrdenProducto_fk0` (`productoId`),
  ADD KEY `OrdenProducto_fk1` (`ordenId`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`presentacionId`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`productoId`),
  ADD KEY `Producto_fk2` (`presentacionId`),
  ADD KEY `producto_FK` (`laboratorioId`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rolescod`);

--
-- Indices de la tabla `roles_usuarios`
--
ALTER TABLE `roles_usuarios`
  ADD PRIMARY KEY (`usercod`,`rolescod`),
  ADD KEY `rol_usuario_key_idx` (`rolescod`),
  ADD KEY `fk_roles_usuarios_roles_usuarios1_idx` (`roles_usuarios_usercod`,`roles_usuarios_rolescod`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usercod`),
  ADD UNIQUE KEY `useremail_UNIQUE` (`useremail`),
  ADD KEY `usertipo` (`usertipo`,`useremail`,`usercod`,`userest`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `bitacoracod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `carritoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `carritoproducto`
--
ALTER TABLE `carritoproducto`
  MODIFY `carritoProductoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `inventarioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `laboratorioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `ordenId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `ordenproducto`
--
ALTER TABLE `ordenproducto`
  MODIFY `ordenProductoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `presentacionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `productoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usercod` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_carrito_usuario1` FOREIGN KEY (`usuario_usercod`) REFERENCES `usuario` (`usercod`);

--
-- Filtros para la tabla `carritoproducto`
--
ALTER TABLE `carritoproducto`
  ADD CONSTRAINT `CarritoProducto_fk0` FOREIGN KEY (`productoId`) REFERENCES `producto` (`productoId`),
  ADD CONSTRAINT `CarritoProducto_fk1` FOREIGN KEY (`carritoId`) REFERENCES `carrito` (`carritoId`);

--
-- Filtros para la tabla `funciones_roles`
--
ALTER TABLE `funciones_roles`
  ADD CONSTRAINT `funcion_rol_key` FOREIGN KEY (`rolescod`) REFERENCES `roles` (`rolescod`),
  ADD CONSTRAINT `rol_funcion_key` FOREIGN KEY (`fncod`) REFERENCES `funciones` (`fncod`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_FK` FOREIGN KEY (`productoId`) REFERENCES `producto` (`productoId`);

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `fk_orden_usuario1` FOREIGN KEY (`usuario_usercod`) REFERENCES `usuario` (`usercod`);

--
-- Filtros para la tabla `ordenproducto`
--
ALTER TABLE `ordenproducto`
  ADD CONSTRAINT `OrdenProducto_fk0` FOREIGN KEY (`productoId`) REFERENCES `producto` (`productoId`),
  ADD CONSTRAINT `OrdenProducto_fk1` FOREIGN KEY (`ordenId`) REFERENCES `orden` (`ordenId`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `Producto_fk2` FOREIGN KEY (`presentacionId`) REFERENCES `presentacion` (`presentacionId`),
  ADD CONSTRAINT `producto_FK` FOREIGN KEY (`laboratorioId`) REFERENCES `laboratorio` (`laboratorioId`);

--
-- Filtros para la tabla `roles_usuarios`
--
ALTER TABLE `roles_usuarios`
  ADD CONSTRAINT `fk_roles_usuarios_roles_usuarios1` FOREIGN KEY (`roles_usuarios_usercod`,`roles_usuarios_rolescod`) REFERENCES `roles_usuarios` (`usercod`, `rolescod`),
  ADD CONSTRAINT `rol_usuario_key` FOREIGN KEY (`rolescod`) REFERENCES `roles` (`rolescod`),
  ADD CONSTRAINT `usuario_rol_key` FOREIGN KEY (`usercod`) REFERENCES `usuario` (`usercod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
