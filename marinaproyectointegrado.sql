-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-06-2022 a las 00:46:21
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `marinaproyectointegrado`
--
CREATE DATABASE IF NOT EXISTS `marinaproyectointegrado` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `marinaproyectointegrado`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas`
--

DROP TABLE IF EXISTS `artistas`;
CREATE TABLE IF NOT EXISTS `artistas` (
  `dni_art` varchar(9) CHARACTER SET utf8mb4 NOT NULL,
  `nombreArtistico` text NOT NULL,
  `fechaComienzo` date NOT NULL,
  `tecnicas` text,
  `redSocial` text,
  PRIMARY KEY (`dni_art`),
  KEY `dni_art` (`dni_art`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `artistas`
--

INSERT INTO `artistas` (`dni_art`, `nombreArtistico`, `fechaComienzo`, `tecnicas`, `redSocial`) VALUES
('47513259P', 'Maria Martin', '2022-06-16', 'Oleo, escultura', 'Instagram: maria44'),
('72415478B', 'Lurenart', '2020-07-15', 'vidrieras', 'Instagram:lurenartt'),
('74860436S', 'chica3d', '2021-12-15', '', 'Instagram:chica3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientecomentaobra`
--

DROP TABLE IF EXISTS `clientecomentaobra`;
CREATE TABLE IF NOT EXISTS `clientecomentaobra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_obra` int(11) NOT NULL,
  `id_cliente` varchar(9) CHARACTER SET utf8mb4 NOT NULL,
  `comentario` varchar(120) DEFAULT NULL,
  `fechaComentario` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_obra` (`id_obra`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientecomentaobra`
--

INSERT INTO `clientecomentaobra` (`id`, `id_obra`, `id_cliente`, `comentario`, `fechaComentario`) VALUES
(207, 1, '67548768D', 'Me encanta', '2022-06-20 20:44:25'),
(208, 46, '47562244G', 'Comentario', '2022-06-20 21:57:20'),
(209, 46, '47562244G', 'me encanta', '2022-06-20 21:57:29'),
(211, 47, '67548768D', 'Me encanta', '2022-06-21 00:26:22'),
(213, 46, '47562244G', 'Es precioso.', '2022-06-21 01:00:17'),
(214, 46, '47562244G', 'Muy bonito.', '2022-06-21 01:00:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientepuja`
--

DROP TABLE IF EXISTS `clientepuja`;
CREATE TABLE IF NOT EXISTS `clientepuja` (
  `id_subasta` int(11) NOT NULL,
  `dni_cliente` varchar(9) CHARACTER SET utf8mb4 NOT NULL,
  `precio` int(11) NOT NULL,
  KEY `id_subasta` (`id_subasta`),
  KEY `dni_cliente` (`dni_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientepuja`
--

INSERT INTO `clientepuja` (`id_subasta`, `dni_cliente`, `precio`) VALUES
(13, '47562244G', 700),
(13, '47562244G', 1200),
(13, '47562244G', 1201),
(13, '47562244G', 1208),
(13, '47562244G', 1209),
(13, '47562244G', 1210),
(13, '47562244G', 1212),
(13, '47562244G', 2214),
(13, '47562244G', 2215),
(13, '47562244G', 2216),
(13, '47562244G', 2217),
(13, '47562244G', 2218),
(13, '47562244G', 2220),
(13, '47562244G', 2222),
(26, '47562244G', 1500),
(26, '47562244G', 2500),
(9, '47562244G', 57000),
(13, '47562244G', 3000),
(84, '47562244G', 200),
(84, '67548768D', 300),
(84, '47562244G', 400),
(84, '67548768D', 500),
(87, '47562244G', 100),
(87, '47562244G', 200),
(87, '67548768D', 300),
(88, '47562244G', 200),
(88, '67548768D', 300),
(88, '47562244G', 500),
(88, '47562244G', 550);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientepuntuaobra`
--

DROP TABLE IF EXISTS `clientepuntuaobra`;
CREATE TABLE IF NOT EXISTS `clientepuntuaobra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni_cliente` varchar(9) CHARACTER SET utf8mb4 NOT NULL,
  `id_obra` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dni_cliente` (`dni_cliente`),
  KEY `id_obra` (`id_obra`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientepuntuaobra`
--

INSERT INTO `clientepuntuaobra` (`id`, `dni_cliente`, `id_obra`, `puntuacion`) VALUES
(44, '47562244G', 1, 6),
(45, '47562244G', 2, 3),
(50, '47562244G', 4, 10),
(56, '67548768D', 1, 10),
(57, '47562244G', 46, 7),
(58, '47562244G', 47, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra`
--

DROP TABLE IF EXISTS `obra`;
CREATE TABLE IF NOT EXISTS `obra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreObra` text NOT NULL,
  `dimensiones` text NOT NULL,
  `materiales` text NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `descripcion` text NOT NULL,
  `tipoObra` text NOT NULL,
  `fotoObra` text NOT NULL,
  `dni_art` varchar(9) CHARACTER SET utf8mb4 NOT NULL,
  `fechaCreacionPost` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_autor` (`dni_art`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `obra`
--

INSERT INTO `obra` (`id`, `nombreObra`, `dimensiones`, `materiales`, `fechaInicio`, `fechaFin`, `descripcion`, `tipoObra`, `fotoObra`, `dni_art`, `fechaCreacionPost`) VALUES
(1, 'Modelo tribu africana', '15 x 15', 'EncaÃºstica sobre tabla', '2021-12-21', '2022-04-22', 'Retrato de una modelo de una tribu africana.', 'Retrato', 'modeloTribuAfricana.jpeg', '47513259P', '2022-06-05 06:09:32'),
(2, 'NiÃ±o sacÃ¡ndose una espina', '150x80', 'Carboncillo', '2021-07-05', '2022-02-09', 'Retrato de una escultura griega', 'Cuadro', 'niÃ±oQuitandoAstilla.jpeg', '47513259P', '2022-04-12 22:12:32'),
(3, 'La niÃ±a triste', '90x70', 'AcrÃ­lico', '2022-01-13', '2022-04-11', 'Retrato de la propia autora', 'Autoretrato', 'niÃ±aTriste.jpeg', '72415478B', '2022-05-03 03:16:30'),
(4, 'Obsidian', '15x10', 'Lapices de madera', '2022-01-11', '2022-04-11', 'Dibujo de Marceline y Chicle de Hora de Aventuras.', 'Dibujo', 'obsidian.jpeg', '72415478B', '2022-02-14 17:26:44'),
(43, 'Groot', '5x5', 'Vidrio', '2022-06-01', '2022-06-10', 'Vidriera de Groot.', 'Vidriera', 'groot.jpeg', '72415478B', '2022-06-20 20:42:32'),
(44, 'DragÃ³n', '5x5', 'Lapices de madera', '2022-06-08', '2022-06-10', 'Dibujo de un dragÃ³n.', 'Dibujo', 'dragon.jpg', '74860436S', '2022-06-20 21:37:57'),
(45, 'Alien', '6x6', 'Rotuladores', '2022-06-07', '2022-06-07', 'Dibujo de un cartel de alien', 'Dibujo', 'alien.jpg', '74860436S', '2022-06-20 21:46:18'),
(46, 'CrÃ­tica al arte', '5x5', 'LÃ¡pices de madera', '2022-06-08', '2022-06-11', 'Representa la crÃ­tica hacia el arte.', 'Dibujo', 'criticaArte.jpeg', '72415478B', '2022-06-20 21:48:07'),
(47, 'Koi', '5x5', 'Acuarelas', '2022-06-07', '2022-06-17', '', 'Dibujo', 'koi.jpg', '74860436S', '2022-06-20 22:09:20'),
(48, 'Barrio de Santa Cruz', '5x5', 'LÃ¡pices de madera', '2022-06-09', '2022-06-11', 'Dibujo del barrio de Santa Cruz', 'Dibujo', 'barrioSantaCruz.jpeg', '72415478B', '2022-06-20 22:11:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subasta`
--

DROP TABLE IF EXISTS `subasta`;
CREATE TABLE IF NOT EXISTS `subasta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_obra` int(11) NOT NULL,
  `precioInicial` int(11) NOT NULL,
  `fechaInicioSubasta` datetime NOT NULL,
  `fechaFinSubasta` datetime NOT NULL,
  `descripcion` text NOT NULL,
  `estado` text,
  `idGanador` text,
  PRIMARY KEY (`id`),
  KEY `id_obra` (`id_obra`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subasta`
--

INSERT INTO `subasta` (`id`, `id_obra`, `precioInicial`, `fechaInicioSubasta`, `fechaFinSubasta`, `descripcion`, `estado`, `idGanador`) VALUES
(9, 3, 5000, '2022-06-05 06:09:32', '2022-06-19 21:10:00', 'Subasta de la obra La niÃ±a triste.', 'finalizado', '47562244G'),
(13, 1, 1000, '2022-06-05 22:56:30', '2022-06-19 22:01:00', 'Subasta de la obra Modelo Tribu africana.', 'finalizado', '47562244G'),
(26, 2, 1000, '2022-06-09 18:47:24', '2022-06-09 18:49:00', 'Subasta', 'finalizado', '47562244G'),
(32, 4, 20000, '2022-06-10 23:39:30', '2022-06-11 23:41:00', 'Subasta de la obra Obsidian', 'finalizado', NULL),
(84, 43, 100, '2022-06-20 22:00:12', '2022-06-20 22:03:00', 'Subasta de la vidriera Groot.', 'finalizado', '67548768D'),
(85, 44, 50, '2022-06-21 00:20:16', '2022-06-25 00:19:00', 'Subasta del dibujo DragÃ³n.', 'vigente', NULL),
(86, 45, 70, '2022-06-21 00:20:33', '2022-06-30 00:20:00', 'Subasta del dibujo Alien.', 'vigente', NULL),
(87, 47, 80, '2022-06-21 00:20:52', '2022-06-23 00:20:00', 'subasta del dibujo Koi.', 'vigente', NULL),
(88, 46, 100, '2022-06-21 02:36:28', '2022-06-21 02:39:00', 'Subasta de la obra Critica al arte', 'vigente', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `dni` varchar(9) CHARACTER SET utf8mb4 NOT NULL,
  `nombre_usuario` text NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `tipo` text NOT NULL,
  `nombre` text NOT NULL,
  `apellido1` text NOT NULL,
  `apellido2` text,
  `fotoPerfil` text NOT NULL,
  `presentacion` text,
  `correo` text NOT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre_usuario`, `contrasenya`, `tipo`, `nombre`, `apellido1`, `apellido2`, `fotoPerfil`, `presentacion`, `correo`) VALUES
('47513259P', 'Mariaaa', '$2y$10$aB9sLx78hnmtR8jV0CYi0eJhPMjxp0tzmtldwbr8Iw3UlABNwZYsG', 'artista', 'Maria', 'Martin', 'Sanchez', 'maria.png', 'Holas', 'maria@gmail.com'),
('47562244G', 'marinan', '$2y$10$kFcyBCQTEs24Tm.iY4oam.xsO7uPEGn7IjOvsB2dHuulfjEgqMSuy', 'cliente', 'Marina', 'Aparicio', 'Santo', 'marina.png', 'soy clienta', 'marinaapariciosantos@gmail.com'),
('67548768D', 'Valeria', '$2y$10$AqX.Qp65ujRx.Rp00Etl/OXErEWyOqoyfrDu1DKqsfVtP2NapLDc.', 'cliente', 'Valeria', 'Gutierrez', 'SÃ¡nchez', 'marina.png', 'Soy Valeria', 'valeria@gmail.com'),
('72415478B', 'Lurena', '$2y$10$ghaqASFMvHVBk7Ezx/rQYOnF6YgHUSbWrKlzZ7DFZ9FI6c94R4CQ2', 'artista', 'Lorena', 'Rosillo', 'Roldan', 'lorena.png', 'holaaaa', 'lorena@gmail.com'),
('74860436S', 'chica3d', '$2y$10$7Jqnd0oG0q3DXHJvhNPyxexCr2t1JE3RQUhZLS9Bp97T0qdfvCN1C', 'artista', 'RocÃ­o', 'Rivero', 'Ortiz', 'maria.png', 'Soy RocÃ­o.', 'rocio@gmail.com'),
('76350956T', 'Simon', '$2y$10$N9idImpgmFRUevNGSYNKG.6KwoKnl6zmCmLIGdPEJyoNXn1f9i3KG', 'admin', 'simon', 'vazquez', 'ochoa', '', 'aaa', 'simon@gmail.com'),
('86548769P', 'Jasmine', '$2y$10$DeVKLStrabQlmwE9JiZXe.WJcq9bgcAX2eOlSMx9JgI724yFFJ7mG', 'cliente', 'Jasmine', 'SÃ¡nchez', 'Guerrero', 'lorena.png', 'Hola soy Jasmine', 'jasminesanchez@gmail.com');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `artistas`
--
ALTER TABLE `artistas`
  ADD CONSTRAINT `artistas_ibfk_1` FOREIGN KEY (`dni_art`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientecomentaobra`
--
ALTER TABLE `clientecomentaobra`
  ADD CONSTRAINT `clientecomentaobra_ibfk_1` FOREIGN KEY (`id_obra`) REFERENCES `obra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clientecomentaobra_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientepuja`
--
ALTER TABLE `clientepuja`
  ADD CONSTRAINT `clientepuja_ibfk_1` FOREIGN KEY (`id_subasta`) REFERENCES `subasta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clientepuja_ibfk_2` FOREIGN KEY (`dni_cliente`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientepuntuaobra`
--
ALTER TABLE `clientepuntuaobra`
  ADD CONSTRAINT `clientepuntuaobra_ibfk_1` FOREIGN KEY (`dni_cliente`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clientepuntuaobra_ibfk_2` FOREIGN KEY (`id_obra`) REFERENCES `obra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `obra`
--
ALTER TABLE `obra`
  ADD CONSTRAINT `obra_ibfk_1` FOREIGN KEY (`dni_art`) REFERENCES `artistas` (`dni_art`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subasta`
--
ALTER TABLE `subasta`
  ADD CONSTRAINT `subasta_ibfk_1` FOREIGN KEY (`id_obra`) REFERENCES `obra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
