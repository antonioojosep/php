-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2024 a las 20:03:19
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` enum('public','private') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `forum`
--

INSERT INTO `forum` (`id`, `name`, `type`) VALUES
(1, 'Deportes', 'public'),
(2, 'Finanzas', 'public'),
(3, 'Gastronomía', 'private');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matter`
--

CREATE TABLE `matter` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `forum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `matter`
--

INSERT INTO `matter` (`id`, `name`, `status`, `forum`) VALUES
(3, 'Rafa Nadal, futuro entrenador de Alcaraz', 'active', 1),
(4, 'Lamine Yamal, futura estrella', 'active', 1),
(5, 'La subida de BitCoin', 'active', 2),
(6, 'Próxima crisis', 'active', 2),
(7, 'Subida del IRPF', 'active', 2),
(8, 'Restaurante a poniente consigue nueva estrella michelín.', 'active', 3),
(9, 'Nuevos soles de la guía repsol repartidos en España.', 'active', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `response`
--

CREATE TABLE `response` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `matter` int(11) DEFAULT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `response`
--

INSERT INTO `response` (`id`, `text`, `status`, `matter`, `user`) VALUES
(17, 'Yo pienso que llegará a ser un gran entrenador', 'active', 3, 'antonio'),
(18, 'Alcaraz tiene mucho pontencial', 'active', 3, 'antonio'),
(19, 'En mi opinión Nadal siempre va a ser mejor que Alcaraz', 'active', 3, 'admin'),
(20, 'El próximo messi', 'active', 4, 'admin'),
(21, 'Es el mejor', 'active', 4, 'antonio'),
(22, 'No podemos perderlo', 'active', 4, 'antonio'),
(23, 'Gran noticia, este restaurante merece lo mejor', 'active', 8, 'antonio'),
(24, 'Es el mejor restaurante que e probado', 'active', 8, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `nickname` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `type` enum('admin','user') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`nickname`, `password`, `email`, `avatar`, `type`, `status`) VALUES
('admin', 'admin', 'admin@admin.com', 'camiseta.png', 'admin', 'active'),
('antonio', 'antonio', 'antonio@antonio.com', 'Screenshot_2021-04-28-23-24-35.png', 'user', 'active');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `matter`
--
ALTER TABLE `matter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_matter_forum` (`forum`);

--
-- Indices de la tabla `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_responseUser_matter` (`user`),
  ADD KEY `fk_response_matter` (`matter`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nickname`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `matter`
--
ALTER TABLE `matter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `response`
--
ALTER TABLE `response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `matter`
--
ALTER TABLE `matter`
  ADD CONSTRAINT `fk_matter_forum` FOREIGN KEY (`forum`) REFERENCES `forum` (`id`);

--
-- Filtros para la tabla `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `fk_responseUser_matter` FOREIGN KEY (`user`) REFERENCES `users` (`nickname`),
  ADD CONSTRAINT `fk_response_matter` FOREIGN KEY (`matter`) REFERENCES `matter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
