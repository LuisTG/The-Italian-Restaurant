-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2017 a las 05:14:48
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u231824686_itabd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `usuarios_nombre_usuario` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `id_pedido` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contenido` text COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('queja','sugerencia','comentario') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `usuarios_nombre_usuario`, `id_pedido`, `contenido`, `tipo`) VALUES
(1, 'Leo77', NULL, 'Excelente servicio, sigan asÃ­!!!', 'comentario'),
(2, 'Leo77', NULL, 'Me gustaria que las bebidas tubieran mejor sabor.', 'queja'),
(3, 'Leo77', NULL, 'La frescura de los alimentos es lo que me hace siempr volver, buen trabajo!', 'comentario'),
(4, 'Leo77', NULL, 'Me gustaria que las porciones fueran mas grandes...', 'sugerencia'),
(5, 'Leo77', NULL, 'He pedido mas de 10 ordenes y siempre llegan a tiempo, muchas gracias!', 'sugerencia'),
(6, '8907', NULL, 'eSTO ES UN COMETTOP', 'comentario'),
(7, 'PATY', NULL, 'MUY BUEN SERVICIO', 'comentario'),
(8, 'PATY', NULL, 'En el pedido numero 591ddcce4b66e mi spaguetthy llego abierto. No me lo como por ser insalubre.\r\n', 'queja'),
(9, 'Leo77', NULL, 'Excelente servicio!', 'comentario'),
(10, 'Leo77', NULL, 'Comentario de prueba', 'comentario'),
(11, 'Leo77', NULL, 'Otro comentario', 'queja'),
(12, 'Leo77', '5915d00a44575', 'De nuevo, otro comentario.', 'comentario'),
(13, 'Leo77', NULL, 'Comentario de prueba', 'comentario'),
(14, 'Leo77', '5922631b31f94', 'Mi hamburguesa estaba podrida y llego tarde', 'queja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `usuarios_nombre_usuario` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` float(6,2) NOT NULL,
  `estado` enum('entregado','espera','cancelado') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `usuarios_nombre_usuario`, `fecha`, `monto`, `estado`) VALUES
('590b5d2ba9ffd', 'Leo77', '2017-05-04 00:00:00', 110.00, 'entregado'),
('590b60644f46d', 'Leo77', '2017-05-04 00:00:00', 110.00, 'cancelado'),
('590b627c8e9c1', 'Leo77', '2017-05-04 00:00:00', 100.00, 'cancelado'),
('590b7ff65a0b8', 'Admin007', '2017-05-04 00:00:00', 360.00, 'entregado'),
('590b811819752', '8907', '2017-05-04 00:00:00', 2610.00, 'entregado'),
('5910ad65647ec', 'Leo77', '2017-05-08 00:00:00', 285.00, 'entregado'),
('5910b6cc77845', 'Leo77', '2017-05-08 00:00:00', 205.00, 'entregado'),
('5910be0881cb5', 'Leo77', '2017-05-08 00:00:00', 1120.00, 'entregado'),
('5915d00a44575', 'Leo77', '2017-05-12 00:00:00', 800.00, 'cancelado'),
('591dda3f8d1b7', 'PATY', '2017-05-18 00:00:00', 1650.00, 'entregado'),
('591dda7772f95', 'PATY', '2017-05-18 00:00:00', 40.00, 'cancelado'),
('591ddcce4b66e', 'PATY', '2017-05-18 00:00:00', 110.00, 'entregado'),
('5922631b31f94', 'Leo77', '2017-05-22 00:00:00', 100.00, 'entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `precio` float(6,2) NOT NULL,
  `imagen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('postre','bebida','platillo') COLLATE utf8_unicode_ci NOT NULL,
  `habilitada` enum('alta','baja') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'alta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `imagen`, `tipo`, `habilitada`) VALUES
(13, 'Pizza con champiÃ±ones', 'Una rica pizza con los ingredientes mas frescos que puedes encontrar en un restaurante.', 120.00, 'img/productos/receta-pizza-romana.jpg', 'platillo', 'alta'),
(14, 'Spaghetti alla carbonara', 'Delicioso spaguetti estilo italiano cubierto de finas especias.', 100.00, 'img/productos/spaghetti-alla-carbonara-92664-1.jpeg', 'platillo', 'alta'),
(15, 'Bucatini all amatriciana', 'Los bucatini son unos espaguetis gordos y con un agujero por dentro y la salsa lleva queso y tomate', 110.00, 'img/productos/Bucatini-AllAmatriciana.jpg', 'platillo', 'alta'),
(16, 'Limoncello', 'Esta bebida alcohÃ³lica italiana estÃ¡ elaborada a base de cÃ¡scara de limÃ³n, alcohol, azÃºcar y ag', 50.00, 'img/productos/limoncello large.jpg.653x0_q80_crop-smart.jpg', 'bebida', 'alta'),
(17, 'Grappa', 'Es una bebida obtenida de la fermentaciÃ³n de las semillas, tallos y cÃ¡scaras de la uva.', 70.00, 'img/productos/real-grappa-social.jpg', 'bebida', 'alta'),
(18, 'Panna Cotta', 'Elaborado con nata , azÃºcar  y gelatina, que se suele adornar con mermeladas de frutas rojas.', 45.00, 'img/productos/panna-cotta.jpg', 'postre', 'alta'),
(19, 'Migliaccio Napolitano', 's una especie de pastel de queso pero mucho mÃ¡s suave, va relleno de queso ricota y sÃ©mola.', 40.00, 'img/productos/IMG_3195.jpg', 'postre', 'alta'),
(20, 'Producto de Prueba', 'Un producto de prueba', 500.00, 'img/productos/nav_background.jpg', 'platillo', 'alta'),
(21, 'Lasagna a la rossini', 'este es un producto de prueba', 250.00, 'img/productos/o-SAUSAGE-LASAGNA-facebook.jpg', 'platillo', 'alta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_pedidos`
--

CREATE TABLE `productos_pedidos` (
  `id_producto_pedido` int(11) NOT NULL,
  `productos_id_producto` int(11) NOT NULL,
  `pedidos_id_pedido` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos_pedidos`
--

INSERT INTO `productos_pedidos` (`id_producto_pedido`, `productos_id_producto`, `pedidos_id_pedido`, `cantidad`) VALUES
(1, 15, '590b5d2ba9ffd', 1),
(2, 15, '590b60644f46d', 1),
(3, 14, '590b627c8e9c1', 1),
(4, 13, '590b7ff65a0b8', 1),
(5, 13, '590b7ff65a0b8', 1),
(6, 13, '590b7ff65a0b8', 1),
(7, 13, '590b811819752', 10),
(8, 13, '590b811819752', 10),
(9, 14, '590b811819752', 1),
(10, 15, '590b811819752', 1),
(11, 13, '5910ad65647ec', 2),
(12, 18, '5910ad65647ec', 1),
(13, 13, '5910b6cc77845', 1),
(14, 18, '5910b6cc77845', 1),
(15, 19, '5910b6cc77845', 1),
(16, 14, '5910be0881cb5', 6),
(17, 17, '5910be0881cb5', 4),
(18, 19, '5910be0881cb5', 6),
(19, 14, '5915d00a44575', 8),
(20, 13, '591dda3f8d1b7', 6),
(21, 17, '591dda3f8d1b7', 6),
(22, 18, '591dda3f8d1b7', 6),
(23, 19, '591dda3f8d1b7', 6),
(24, 19, '591dda7772f95', 1),
(25, 15, '591ddcce4b66e', 1),
(26, 14, '5922631b31f94', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre_usuario` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `nombres` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('admin','client') COLLATE utf8_unicode_ci NOT NULL,
  `fotografia` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'img/default/profile.png',
  `habilitada` enum('alta','baja') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'alta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre_usuario`, `contrasena`, `nombres`, `apellidos`, `telefono`, `correo`, `tipo`, `fotografia`, `habilitada`) VALUES
('8907', 'a633e6c0755a6cab50660ebe4546006333b7f2fcfb28dbbbd28c33f3009b91dc', 'DELIO COSS', 'COSS CAMILO', '9999999999', 'DELIOC@HOTMAIL.COM', 'client', 'img/profile_picture/590b813555574.jpg', 'alta'),
('Admin007', '4778927020054dbddf536e69c869d550e826dc75dbd1015532ba34c46193c6dc', 'Homero', 'Sanchez', '5555555555', 'homero@mail.me', 'admin', 'img/profile_picture/59175eeba6f00.png', 'alta'),
('Coco95', 'ffaa851fd26fab7839c42e534b82bf3b37aa51a4cb79e089fdc9dc5d45d505b6', 'Arturo de Jesus', 'Martinez Cura', '2291384237', 'artm94@hotmail.com.mx', 'client', 'img/default/profile.png', 'baja'),
('Gohan09', '471a272588d075051756141caa35d51ef75d683f47217737f26c2c2e136e1550', 'Gohan', 'Gomez', '2291768909', 'art94.am@gmail.co', 'client', 'img/default/profile.png', 'alta'),
('Jorge95', 'e2198b8988ccae66f7338e49776a02adfccaa133e092ba3b8313d1b41faba3e0', 'Jorge Emilio', 'Sanchez Gomez', '2291384237', 'jquery@mail.me', 'client', 'img/default/profile.png', 'alta'),
('Leo77', '471a272588d075051756141caa35d51ef75d683f47217737f26c2c2e136e1550', 'Luis Angel', 'Trujillo Garcia', '2291333167', 'artm94@hotmail.com', 'client', 'img/profile_picture/5926e56f006c4.png', 'alta'),
('milhouse', 'e1512c8ea01b9302eb03eed987d3d0dbb3d0f03d98a699b541f8ad8ed1c4958a', 'Luis Ãngel', 'Trujillo GarcÃ­a', '2299143499', 'a@b.com', 'client', 'img/default/profile.png', 'alta'),
('PATY', '4778927020054dbddf536e69c869d550e826dc75dbd1015532ba34c46193c6dc', 'Patricia ', 'Horta Rosado', '9090909090', '1@1.com', 'client', 'img/default/profile.png', 'alta'),
('Stevie007', 'ffaa851fd26fab7839c42e534b82bf3b37aa51a4cb79e089fdc9dc5d45d505b6', 'Arturo de Jesus', 'Martinez Cura', '2291556789', 'art94.am@gmail.com', 'client', 'img/default/profile.png', 'alta');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `usuarios_nombre_usuario` (`usuarios_nombre_usuario`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `usuarios_nombre_usuario` (`usuarios_nombre_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  ADD PRIMARY KEY (`id_producto_pedido`),
  ADD KEY `productos_id_producto` (`productos_id_producto`),
  ADD KEY `pedidos_id_pedido` (`pedidos_id_pedido`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  MODIFY `id_producto_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `comentarios_nombre_usuario_fk` FOREIGN KEY (`usuarios_nombre_usuario`) REFERENCES `usuarios` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_nombre_usuario_fk` FOREIGN KEY (`usuarios_nombre_usuario`) REFERENCES `usuarios` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  ADD CONSTRAINT `productos_pedidos_ibfk_1` FOREIGN KEY (`pedidos_id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_pedidos_id_producto` FOREIGN KEY (`productos_id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
